<x-app title="Usuarios">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado de productos</h1>
        </div>

        <the-product-list :products="{{ $products }}"/>
    </section>

	<x-slot:scripts>
        <script>
            document.addEventListener("DOMContentLoaded", loadDatatable);

            function loadDatatable() {
                $('#user_table').DataTable()
            }

            async function deleteForm(user_id) {
                const response = await Swal.fire({
                    icon: 'warning',
                    title: 'Esta seguro de eliminar?',
                    showCancelButton: true
                })
                if (!response.isConfirmed) return
                document.getElementById(`delete_form_${user_id}`).submit();
            };
        </script>
    </x-slot:scripts>
</x-app>
