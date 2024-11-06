@if (auth()->user()->studentCourses()->where('course_id',$details['id'])->first() == '')
    {{-- <button type="button" class="default-btn" data-bs-toggle="modal" data-bs-target="#buyNowModal">
        {{trans('common.buyNow')}}
    </button> --}}
    <button class="add-to-cart-btn default-btn" data-product-id="{{ $details->id }}">{{trans('common.buyNow')}}</button>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.add-to-cart-btn').click(function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{route("user.cart.add")}}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                        },
                        data: { product_id: productId },
                        success: function(response) {
                            alert(response.message);
                            // Update the cart view (you might use a separate AJAX call to fetch updated cart data)
                            // Example: $('#cart-items-container').load('/cart');
                            updateCartCount();
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 403) {
                                faildModal('لا يمكنك إتمام الطلب إلا بعد تفعيل حسابك');
                            } else {
                                alert('An error occurred: ' + status);
                                console.error(xhr.responseText);
                            }
                        }
                    });
                });
            });
            // Function to update cart count
            function updateCartCount() {
                $.ajax({
                    url: '{{route("user.cart.count")}}',
                    method: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response.count);
                        $('#cart-count2').text(response.count);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function faildModal(content) {
                var modal = `
                    <div class="modal fade" id="confirmationFaildModal" tabindex="-1" role="dialog" aria-labelledby="confirmationFaildModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content d-flex flex-column ">
                                <button type="button" class="close align-self-start p-2" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title fw-bolder" id="confirmationFaildModalLabel">يوجد خطأ<span class="y-text"> لم نستطع إضافة طلبك </span></h4>

                                <div class="modal-body d-flex flex-column align-items-center">
                                    <div>${content}</div>
                                    <button  data-dismiss="modal" class="btn btn-primary w-100 mt-2">إغلاق</button>
                                    <a href="{{route('user.dashboard.index')}}" class="btn btn-info w-100 mt-2">لوحة تحكم الحساب</a>
                                </div>

                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('modalsContainer').innerHTML = modal;
                $('#confirmationFaildModal').modal('show');
            }
        </script>
    @stop
@else
    لقد قمت بشراء هذا المحتوى من قبل
@endif


