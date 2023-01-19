</div>
    <script>
        window.history.replaceState(null, null, window.location.pathname);
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()

        $('.konsultasi').click(function() {
            var dataid = $(this).attr('data-id');
            if ($(this).prop('checked')) {
                window.location = "data.php?switch=0&id=" + dataid
            } else {
                window.location = "data.php?switch=1&id=" + dataid
            }
        });

        $("#tambah").click(function(e) {
            e.preventDefault()
            $("#keluhan").parent().append('</div><div class="col-12"><input type="text" class="form-control" name="keluhan[]" placeholder="Masukkan keluhan Anda (Optional)">');
        });
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>