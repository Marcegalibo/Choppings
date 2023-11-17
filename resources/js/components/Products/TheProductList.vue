<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Crear producto</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="book_table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Categoria</th>
								<th>Existencias</th>
								<th>Descripción</th>
								<th>Descripción</th>
                                <th>Precio</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product, index) in productss" :key="index">
								<td>{{ product.name }}</td>
								<td>{{ product.category }}</td>
								<td>{{ product.stock }}</td>
                                <td>{{ product.description_corta }}</td>
                                <td>{{ product.description_larga }}</td>
                                <td>{{ product.cost }}</td>
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-warning btn-sm" @click="editProduct(product)">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar"
											@click="deletProduct(product)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<product-modal :product_data="product" ref="product_modal" />
			</div>
		</div>
	</section>
</template>

<script>
import ProductModal from './ProductModal.vue';
import { deleteMessage, successMessage } from '@/helpers/Alerts.js'

export default {
	components: {
		ProductModal

	},
	props: ['products'],
	data() {
		return {
			modal: null,
			product: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#product_table').DataTable()
			const modal_id = document.getElementById('product_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				this.$refs.product_modal.reset()
			})
		},
		editProduct(product) {
			this.product = product
			this.openModal()
		},
		async deletProduct({ id }) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/products/${id}`)
				await successMessage({ is_delete: true, reload: true })
			} catch (error) {
				console.error(error);
			}
		},
		openModal() {
			this.modal.show()
		},
	}
}
</script>
