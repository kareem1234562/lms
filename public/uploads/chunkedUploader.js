class ChunkedUploader {
    constructor(container, options) {
        this.container = container;
        this.options = options;
        this.file = null;
        this.chunkSize = 1024 * 1024 * 5; // 5MB chunks
        this.uploadedChunks = 0;
        this.totalChunks = 0;
        this.initInterface();
    }

    initInterface() {
        this.container.innerHTML = `
            <input type="file" accept="video/*" id="fileInput" style="display: none;">
            <button type="button" id="selectFile" class="btn btn-primary">Select Video</button>
            <div id="uploadProgress" style="display: none;">
                <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
            </div>
        `;

        this.container.querySelector('#selectFile').addEventListener('click', () => {
            this.container.querySelector('#fileInput').click();
        });

        this.container.querySelector('#fileInput').addEventListener('change', (e) => {
            this.file = e.target.files[0];
            this.startUpload();
        });
    }

    startUpload() {
        this.totalChunks = Math.ceil(this.file.size / this.chunkSize);
        this.uploadedChunks = 0;
        this.uploadNextChunk();
    }

    uploadNextChunk() {
        const start = this.uploadedChunks * this.chunkSize;
        const end = Math.min(start + this.chunkSize, this.file.size);
        const chunk = this.file.slice(start, end);

        const formData = new FormData();
        formData.append('file', chunk, this.file.name);
        formData.append('chunkIndex', this.uploadedChunks);
        formData.append('totalChunks', this.totalChunks);

        fetch(this.options.uploadUrl, {
            method: 'POST',
            body: formData,
            headers: this.options.headers
        })
        .then(response => response.json())
        .then(data => {
            this.uploadedChunks++;
            this.updateProgress();

            if (this.uploadedChunks < this.totalChunks) {
                this.uploadNextChunk();
            } else {
                this.finishUpload(data.url);
            }
        })
        .catch(error => {
            console.error('Upload failed:', error);
        });
    }

    updateProgress() {
        const progress = (this.uploadedChunks / this.totalChunks) * 100;
        const progressBar = this.container.querySelector('.progress-bar');
        progressBar.style.width = `${progress}%`;
        progressBar.textContent = `${Math.round(progress)}%`;
        this.container.querySelector('#uploadProgress').style.display = 'block';
    }

    finishUpload(url) {
        document.getElementById('lessonVideoUrl').value = url;
        console.log('Upload completed. Video URL:', url);
    }
}
