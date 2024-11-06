<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colleges;
use App\Models\Univerisities;
use App\Models\Countries;
use App\Models\Courses;
use App\Models\CourseSections;
use App\Models\CourseLessons;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;


use Response;

class LessonsController extends Controller
{
    //
    public function index($course_id)
    {
        $course = Courses::find($course_id);
        $lessons = CourseLessons::where('course_id',$course_id)->where('section_id',0)->orderBy('the_order','asc')->get();
        $sections = CourseSections::where('course_id',$course_id)->orderBy('the_order','asc')->get();

        if ($course->is_course != 1) {
            $country = Countries::find($course->country_id);
            $univerisity = Univerisities::find($course->university_id);
            $college = Colleges::find($course->college_id);
            $breadcrumbs = [
                [
                    'url' => route('admin.countries.index'),
                    'text' => trans('common.countries')
                ],
                [
                    'url' => route('admin.univerisities',$country->id),
                    'text' => trans('learning.univerisities').' في '.$country['name_'.session()->get('Lang')]
                ],
                [
                    'url' => route('admin.colleges',['countryId'=>$country->id,'UniId'=>$univerisity->id]),
                    'text' => trans('learning.colleges').' في '.$univerisity['name_'.session()->get('Lang')]
                ],
                [
                    'url' => '',
                    'text' => trans('learning.curriculums').' في '.$college['name_'.session()->get('Lang')]
                ],
                [
                    'url' => '',
                    'text' => trans('learning.lessons').' في '.$course['name']
                ]
            ];
        } else {
            $breadcrumbs = [
                [
                    'url' => route('admin.courses'),
                    'text' => trans('learning.courses')
                ],
                [
                    'url' => '',
                    'text' => trans('learning.lessons').' في '.$course['name']
                ]
            ];
        }

        return view('AdminPanel.lessons.index',[
            'active' => $course->is_course == 0 ? 'curriculums' : 'courses',
            'title' => trans('learning.lessons'),
            'course' => $course,
            'lessons' => $lessons,
            'sections' => $sections,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    // public function store(Request $request, $course_id)
    // {
    //     $chunk = (int)$request->input('chunk', 0);
    //     $chunks = (int)$request->input('chunks', 0);
    //     $fileName = $request->input('file_name', '');

    //     try {
    //         $file = $request->file('file');
    //         $path = $file->getPathname();

    //         if ($chunk === 0) {
    //             // First chunk, create a new file
    //             $tempFile = tempnam(sys_get_temp_dir(), 'video_upload_');
    //             file_put_contents($tempFile, file_get_contents($path));
    //             session(['temp_file' => $tempFile]);
    //         } else {
    //             // Append chunk to existing file
    //             $tempFile = session('temp_file');
    //             file_put_contents($tempFile, file_get_contents($path), FILE_APPEND);
    //         }

    //         if ($chunk === $chunks - 1) {
    //             // Last chunk, process the complete file
    //             $data = $request->except(['_token', 'lessonVideo', 'lessonFile', 'section', 'chunk', 'chunks', 'file']);
    //             $data['course_id'] = $course_id;
    //             $data['section_id'] = $request['section'];
    //             $create_lesson = CourseLessons::create($data);

    //             if ($create_lesson) {
    //                 $finalPath = $this->moveFileToFinalLocation($tempFile, $fileName, $course_id, $create_lesson->id);
    //                 $data['video'] = $finalPath;
    //                 $data['video_cdn'] = $this->getBunnyNetCdnUrl(basename($finalPath));
    //                 $create_lesson->update($data);

    //                 $this->uploadToBunnyNet(public_path($finalPath), 'lessonVideo');

    //                 // Clear the temporary file from the session
    //                 session()->forget('temp_file');

    //                 return response()->json(['success' => true, 'message' => trans('common.successMessageText')]);
    //             } else {
    //                 return response()->json(['success' => false, 'message' => trans('common.faildMessageText')]);
    //             }
    //         }

    //         return response()->json(['success' => true, 'message' => 'Chunk uploaded']);
    //     } catch (\Exception $e) {
    //         \Log::error('File upload error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Error uploading file: ' . $e->getMessage()], 500);
    //     }
    // }

    public function store(Request $request, $course_id)
    {
        $chunk = (int)$request->input('chunk', 0);
        $chunks = (int)$request->input('chunks', 0);
        $fileName = $request->input('file_name', '');

        try {
            $data = $request->except(['_token', 'lessonVideo', 'lessonFile', 'section', 'chunk', 'chunks', 'file']);
            $data['course_id'] = $course_id;
            $data['section_id'] = $request['section'];

            // Handle the video upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->getPathname();

                if ($chunk === 0) {
                    // First chunk, create a new file
                    $tempFile = tempnam(sys_get_temp_dir(), 'video_upload_');
                    file_put_contents($tempFile, file_get_contents($path));
                    session(['temp_file' => $tempFile]);
                } else {
                    // Append chunk to existing file
                    $tempFile = session('temp_file');
                    file_put_contents($tempFile, file_get_contents($path), FILE_APPEND);
                }

                if ($chunk === $chunks - 1) {
                    // Last chunk, process the complete file
                    $create_lesson = CourseLessons::create($data);

                    if ($create_lesson) {
                        $finalPath = $this->moveFileToFinalLocation($tempFile, $fileName, $course_id, $create_lesson->id);
                        $data['video'] = $finalPath;
                        $data['video_cdn'] = $this->getBunnyNetCdnUrl(basename($finalPath));
                        $create_lesson->update($data);

                        $this->uploadToBunnyNet(public_path($finalPath), 'lessonVideo');

                        // Clear the temporary file from the session
                        session()->forget('temp_file');
                    }
                }
            } else {
                $create_lesson = CourseLessons::create($data);
            }

            // Handle the PDF upload using your existing method
            if ($request->hasFile('lessonFile')) {
                $pdfPath = upload_file('courses/'.$course_id.'/lessons/'.$create_lesson->id, $request->lessonFile);
                $create_lesson->update(['file' => $pdfPath]);
            }

            return response()->json(['success' => true, 'message' => trans('common.successMessageText')]);
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error uploading file: ' . $e->getMessage()], 500);
        }
    }
    private function moveFileToFinalLocation($tempFile, $originalFileName, $course_id, $lesson_id)
    {
        $finalDir = 'uploads/courses/' . $course_id . '/lessons/' . $lesson_id;
        $fullFinalDir = public_path($finalDir);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $finalFileName = Str::random(40) . '.' . $extension;
        $finalPath = $finalDir . '/' . $finalFileName;
        $fullFinalPath = public_path($finalPath);

        if (!File::isDirectory($fullFinalDir)) {
            File::makeDirectory($fullFinalDir, 0755, true, true);
        }

        // Move the temporary file to the final location
        File::move($tempFile, $fullFinalPath);

        return $finalPath;
    }
    private function combineChunks($tempPath, $finalPath, $chunks)
    {
        $buffer = 1024 * 1024; // 1MB buffer size

        $outFile = fopen($finalPath, 'wb');

        for ($i = 0; $i < $chunks; $i++) {
            $chunkFile = $tempPath . '.part' . $i;
            $inFile = fopen($chunkFile, 'rb');

            while (!feof($inFile)) {
                fwrite($outFile, fread($inFile, $buffer));
            }

            fclose($inFile);
            unlink($chunkFile); // Delete the chunk file after combining
        }

        fclose($outFile);
    }

    private function uploadToBunnyNet($filePath, $fileType)
    {
        $REGION = '';  // If German region, set this to an empty string: ''
        $BASE_HOSTNAME = 'storage.bunnycdn.com';
        $HOSTNAME = (!empty($REGION)) ? "{$REGION}.{$BASE_HOSTNAME}" : $BASE_HOSTNAME;
        $STORAGE_ZONE_NAME = 'uniford-vids';
        $FILENAME_TO_UPLOAD = basename($filePath);
        $ACCESS_KEY = '310dc649-3d38-43ee-bd3327ad775b-a929-4bea';

        $url = "https://{$HOSTNAME}/{$STORAGE_ZONE_NAME}/{$FILENAME_TO_UPLOAD}";

        $ch = curl_init();

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PUT => true,
            CURLOPT_INFILE => fopen($filePath, 'r'),
            CURLOPT_INFILESIZE => filesize($filePath),
            CURLOPT_HTTPHEADER => array(
                "AccessKey: {$ACCESS_KEY}",
                'Content-Type: application/octet-stream'
            )
        );

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (!$response) {
            \Log::error("BunnyNet upload error: " . curl_error($ch));
            return false;
        } else {
            // Upload successful, now delete the local file
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            return true;
        }

        curl_close($ch);
    }
    private function getBunnyNetCdnUrl($fileName)
    {
        $CDN_BASE_URL = 'https://storage.bunnycdn.com';  // Replace with your actual CDN URL
        $STORAGE_ZONE_NAME = 'uniford-vids';  // Replace with your actual storage zone name

        return "https://uniford-vids-pull.b-cdn.net/{$fileName}";
    }
    public function update(Request $request,$course_id,$lesson_id)
    {
        $data = $request->except(['_token','lessonVideo','lessonFile','section']);
        $data['course_id'] = $course_id;
        $data['section_id'] = $request['section'];
        $lesson = CourseLessons::find($lesson_id);
        $create_lesson = CourseLessons::find($lesson_id)->update($data);
        if ($create_lesson) {
            if ($request->hasFile('lessonVideo') != '') {
                if ($lesson->video != '') {
                    delete_image('uploads/courses/'.$course_id.'/lessons/'.$lesson_id , $lesson->video);
                }
                $data['video'] = upload_file('courses/'.$course_id.'/lessons/'.$lesson_id , $request->lessonVideo );
                $lesson->update($data);
            }
            if ($request->hasFile('lessonFile') != '') {
                if ($lesson->file != '') {
                    delete_image('uploads/courses/'.$course_id.'/lessons/'.$lesson_id , $lesson->file);
                }
                $data['file'] = upload_file('courses/'.$course_id.'/lessons/'.$lesson_id , $request->lessonFile );
                $lesson->update($data);
            }

            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }
    public function sectionsStore(Request $request,$course_id)
    {
        $data = $request->except(['_token']);
        $data['course_id'] = $course_id;
        $create_section = CourseSections::create($data);
        if ($create_section) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }
    public function sectionsUpdate(Request $request,$course_id,$section_id)
    {
        $data = $request->except(['_token']);
        $create_section = CourseSections::find($section_id)->update($data);
        if ($create_section) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    private function deleteFromBunnyNet($fileName)
    {
        $REGION = '';  // If German region, set this to an empty string: ''
        $BASE_HOSTNAME = 'storage.bunnycdn.com';
        $HOSTNAME = (!empty($REGION)) ? "{$REGION}.{$BASE_HOSTNAME}" : $BASE_HOSTNAME;
        $STORAGE_ZONE_NAME = 'uniford-vids';
        $ACCESS_KEY = '310dc649-3d38-43ee-bd3327ad775b-a929-4bea';

        $url = "https://{$HOSTNAME}/{$STORAGE_ZONE_NAME}/{$fileName}";

        $ch = curl_init();

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                "AccessKey: {$ACCESS_KEY}"
            )
        );

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (!$response) {
            die("Error: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 401) {
            die("Error: Unauthorized. Please check your Bunny.net API key.");
        }

        if ($httpCode != 200) {
            die("Error: Failed to delete the file. HTTP Code: $httpCode, Response: $response");
        }

        return true;
    }
    public function deleteVideo($course_id,$lesson_id)
    {
        $lesson = CourseLessons::find($lesson_id);
        if ($lesson->video != '') {
            delete_image('uploads/courses/'.$course_id.'/lessons/'.$lesson_id , $lesson->video);
            $this->deleteFromBunnyNet($lesson->video);
            $data['video'] = '';
            $lesson->update($data);
        }

        return redirect()->back()
                        ->with('success',trans('common.successMessageText'));
    }


    public function deleteFile($course_id,$lesson_id)
    {
        $lesson = CourseLessons::find($lesson_id);
        if ($lesson->file != '') {
            delete_image('uploads/courses/'.$course_id.'/lessons/'.$lesson_id , $lesson->file);
            $data['file'] = '';
            $lesson->update($data);
        }

        return redirect()->back()
                        ->with('success',trans('common.successMessageText'));
    }

    public function delete($course_id,$lesson_id)
    {
        $lesson = CourseLessons::find($lesson_id);
        delete_folder('uploads/courses/'.$course_id.'/lessons/'.$lesson_id);
        if ($lesson->video != null) {
            // $this->deleteFromBunnyNet($lesson->video);
        }
        if ($lesson->delete()) {
            return Response::json($lesson_id);
        }
        return Response::json("false");
    }

    public function sectionsDelete($course_id,$section_id)
    {
        $group = CourseSections::find($section_id);
        if ($group->delete()) {
            return Response::json('section'.$section_id);
        }
        return Response::json("false");
    }
}
