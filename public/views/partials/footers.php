<!-- <script src="../../../js/jquery-3.6.0.min.js"></script> -->
<script src="../../../js/adminlte.min.js"></script>
<script src="../../../js/all.min.js"></script>
<script src="../../../js/bootstrap.bundle.min.js"></script>
<script src="../../../js/jquery.dataTables.min.js"></script>
<script 🇸rc="../../../js/dataTables.bootstrap5.min.js"></script>
<script src="../../../js/dataTables.buttons.min.js"></script>
<script src="../../../js/jszip.min.js"></script>
<script src="../../../js/pdfmake.min.js"></script>
<script src="../../../js/vfs_fonts.js"></script>
<script src="../../../js/buttons.html5.min.js"></script>
<script src="../../../js/buttons.print.min.js"></script>
<script src="../../../js/script.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- DataTables JS -->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

<!-- Manual Treeview Toggle Script -->
<!-- Modal trigger button -->
<!-- <button
    type="button"
    class="btn btn-primary btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
 >
    Launch
 </button> -->

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<!-- <div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"

    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">Body</div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Optional: Place to the bottom of scripts -->
<!-- <script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script> -->
<script>
    $(document).ready(function() {
        $('.has-treeview > a').on('click', function(e) {
            e.preventDefault();
            let parentLi = $(this).parent();
            parentLi.toggleClass('menu-open');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#pushmenu').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('active')
            $('.overlay').toggleClass('active');
            $('.sideb').toggleClass('active');
            $('.container-avs').toggleClass('active');
        });
        $('.overlay').on('click', function(e) {
            e.preventDefault();
            $('body').removeClass('active')
            $(this).removeClass('active');
            $('.sideb').removeClass('active');
            $('.container-avs').removeClass('active');
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Apply DataTables to each table
        $('#birdsBoughtPerYear').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
        $('#genderStats').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
        $('#speciesGenderStats').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
        $('#totalSpentPerYear').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
        $('#totalSpentPerSpecies').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
        $('#breading_table,#feeding_table').DataTable({
            "paging": false,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#birdsTable').DataTable({
            "paging": true,
            "lengthMenu": [10, 15, 25],
            "ordering": true,
            "processing": true,

            "order": [
                [0, "desc"]
            ],
            "info": true,

            "dom": 'Bfrtip', // Position des boutons
            "buttons": [ // Boutons d'exportation
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                // {
                //     extend: 'print',
                //     text: 'print',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // }
            ],
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/French.json"
            // }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#purchasesTable').DataTable();
    });
</script>



<!-- </body>

</html> -->



<!-- jQuery (needed for DataTables) -->


<!-- Initialize DataTables -->