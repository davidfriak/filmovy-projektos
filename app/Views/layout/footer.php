<?php // Společná patička; načítá Bootstrap JS a zapíná TinyMCE editor. ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.tiny.cloud/1/r8l7o5eeiypaxhauraahh7b9pgl163h3l5or620t14002jhy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
tinymce.init({
    selector: '.tinymce',
    height: 300,
    menubar: true,
    plugins: 'lists link table code',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link table | code'
});
</script>

</body>
</html>