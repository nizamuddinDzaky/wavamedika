<!-- Script easy ui -->
<script type="text/javascript">
    $(document).ready(function() {
        $(function($) {
            // For Action
            $(function () {
                $('#tambah').click(function () {
                    $('#win').window('open');
                });
            });


            // Sweet Alert (title, body, icon)
            $('#alert_test').click(function() {
                swal.fire('Good Job!', 'Container body...', 'warning');
            });
        });
    });
</script>
<!-- end script -->