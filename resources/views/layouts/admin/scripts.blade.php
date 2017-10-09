<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="{!! \URLHelper::asset('libs/plugins/jQuery/jQuery-2.1.4.min.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs/bootstrap/js/bootstrap.min.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs//plugins/iCheck/icheck.min.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs/adminlte/js/app.min.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs/bootstrap/bootstrap-select.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs/datetimepicker/js/jquery-dateFormat.min.js', 'admin') !!}"></script>
<script type="text/javascript">
    var Boilerplate = {
        'csrfToken': "{!! csrf_token() !!}"
    };
</script>
<script type="text/javascript">
    var Boilerplate = {
        'csrfToken': "{!! csrf_token() !!}"
    };
    $(function () {
        $('.approve-button').click(function () {
            if (window.confirm("Are you sure to approve this campaign ?") === true) {

                var self = $(this),
                        url = self.attr('data-approve-url');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        '_token': Boilerplate.csrfToken
                    },
                    error: function (xhr, error) {
                        console.log(error);
                        self.loading = false;
                        location.reload();
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                });
            }
        });
    });
    $('.clear-image').click(function () {
        var imageUrl = $('#current-image').val();
        $('#image-preview').attr("src", imageUrl);
        $('#image_id').val();
    });
    function imageValidate(inputImage){
        var warningSpan = $(inputImage).attr('data-key');
        var imagePreview = $(inputImage).attr('data-key');
        var thisWarningSpan = $('.warning-image-'+warningSpan);
        var thisImagePreview = $('.image-preview-'+imagePreview);
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(inputImage).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            if($(inputImage).val() == '' || $(inputImage).val() == null){
                thisWarningSpan.html("");
            }else{
                thisImagePreview.hide();
                thisWarningSpan.html("Invalid format image.");
                $(inputImage).val('');
            }
        }
        else {

            thisImagePreview.attr('src', URL.createObjectURL(event.target.files[0]));
            thisImagePreview.show();
            thisWarningSpan.html("");
        }
    }
    $('.image-input').on("change",function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#spanFileName').html(this.value);
            $('#spanFileName').html("Invalid format image.");
            $('.image-input').val('');
        }
        else {
            $('#spanFileName').html('');
            $('#image-preview').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#image-preview').show();
        }
    })
    $('.load-image').click(function () {
        if ($('#content-images').is(':empty')) {
            $.ajax({
                url: '{!! action('Admin\ImageController@index') !!}',
                method: 'get',
                error: function (xhr, error) {
                    console.log(error);
                    self.loading = false;
                },
                success: function (response) {

                    $('#content-images').html(response);
                }
            });
        }
    });
    function chooseImage() {
        var imageItem = $( "img.selected-image" )[ 0 ];
        if(!jQuery.isEmptyObject(imageItem)){
            var imageId = imageItem.getAttribute("data-image-id");
            var imageUrl = imageItem.getAttribute("src");
            $('#image-preview').attr("src", imageUrl);
            $('#image_id').val(imageId);
            $('#image').val('');
        }
    }
    function changeImage(e) {
        $('.image-choose').removeClass('selected-image');
        jQuery(e).addClass('selected-image');
        $('#select-image-btn').removeClass('hidden');
    }
    function loadMore(totalCount, url) {
        var numItems = $('.image-choose').length;
        if (numItems < parseInt(totalCount)){
            $.ajax({
                url: url,
                method: 'get',
                error: function (xhr, error) {
                    console.log(error);
                    self.loading = false;
                },
                success: function (response) {
                    $('.image-row:last').empty();
                    $('.image-row:last').after(response);
                    var numItems = $('.image-choose').length;
                    if(numItems >=  parseInt(totalCount)){
                        $('.load-more-image').hide();
                    }
                }
            });
        }
    }
    $('.load-user-info').click(function () {
            var self = $(this),
                    url = self.attr('data-user-url');
            console.log(url);
            $.ajax({
                url: url,
                method: 'get',
                data: {
                    '_token': Boilerplate.csrfToken
                },
                error: function (xhr, error) {
                    console.log(error);
                    self.loading = false;
                },
                success: function (response) {
                    console.log(response);
                    $('#content-user-info').html(response);
                }
            });
    });


</script>