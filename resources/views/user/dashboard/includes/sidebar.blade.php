
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">
            <img src="{{auth()->user()->photoLink()}}" alt="{{auth()->user()->name}}" class="rounded-circle p-1 bg-primary" width="110">
            <div class="mt-3">
                <h4>{{auth()->user()->name}}</h4>
                <p class="text-secondary mb-1">{{auth()->user()->email}}</p>
                <a class="btn btn-outline-primary" href="{{ route('user.dashboard.editProfile') }}">{{ trans('user.editProfile') }}</a>
                <a class="btn btn-danger" href="{{ route('website.logout') }}">{{trans('common.Logout')}}</a>
            </div>
        </div>
        <hr class="my-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">{{trans('common.CoinsGaind')}}</h6>
                <span class="text-secondary">{{auth()->user()->coins}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">دورات تدريبية مشترك بها</h6>
                <span class="text-secondary">{{auth()->user()->studentCourses()->count()}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">شهادات حاصل عليها</h6>
                <span class="text-secondary">{{auth()->user()->certificates()}}</span>
            </li>
            {{-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">
                    {{trans('user.wallet')}}
                    <span class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                        {{trans('user.rechargePalance')}}
                    </span>
                </h6>
                <span class="text-secondary">{{auth()->user()->walletNet()}}</span>
            </li> --}}
        </ul>
    </div>
</div>


{{-- <div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!!Form::open(['class'=>'auth-login-form mt-2','url'=>route('user.dashboard.rechargeBalance'),'files'=>'true'])!!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="form-label">{{trans('common.payment_method')}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="online" name="payment_method" id="online_payment" required>
                                <label class="form-check-label" for="online_payment">
                                    Visa / Master Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="manual_transfeer" name="payment_method" id="manual_transfeer_payment" required>
                                <label class="form-check-label" for="manual_transfeer_payment">
                                    {{trans('common.manual_transfeer')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="textInput" class="form-label">{{trans('common.amount')}}</label>
                                <input type="text" name="amount" class="form-control" id="textInput" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="fileInput" class="form-label">{{trans('common.photo')}}</label>
                                <input type="file" name="photo" class="form-control" id="fileInput" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="default-btn">{{trans('common.Save Changes')}}</button>
                        </div>
                    </div>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div> --}}
