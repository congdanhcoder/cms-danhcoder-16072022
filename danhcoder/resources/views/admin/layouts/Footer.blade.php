</div>
<script src="{{ asset('resources/admin/js/jquery-3.6.0.min.js') }}"></script>
<!-- import boostrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- import font awesome 6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

<!-- import Ckediter -->
<script src="{{ asset('public/plugins/ckeditor/ckeditor/ckeditor.js') }}"></script>


<!-- import Codemirror -->
<script src="{{ asset('public/plugins/codemirror5.6/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/plugins/codemirror5.6/mode/xml/xml.js') }}"></script>
<script src="{{ asset('public/plugins/codemirror5.6/addon/edit/closetag.js') }}"></script>

<!-- js main -->
<script src="{{ asset('resources/admin/js/edit-codemirror.js') }}"></script>
<script src="{{ asset('resources/admin/js/main.js') }}"></script>
<script src="{{ asset('resources/admin/js/ajax.js') }}"></script>


<script>
    var editor = CKEDITOR.replace('mytextarea');
    var editor2 = CKEDITOR.replace('mytextareaDesc');
</script>
@yield('scrip')
</body>

</html>