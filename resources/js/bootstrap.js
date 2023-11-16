import _ from 'lodash'
import * as bootstrap from 'bootstrap'
import axios from 'axios'
import Swal from 'sweetalert2'
import jquery from 'jquery'
import 'datatables.net-bs5'
//import '@fortawesome/fontawesome-free/js/all.js'


//import 'datatables.net-buttons-bs5'
//import 'datatables.net-buttons/js/buttons.html5.mjs'

//import jsZip from 'jszip'
//import pdfMake from 'pdfmake/build/pdfmake'
//import pdfFont from 'pdfmake/build/vfs_fonts'
//pdfMake.vfs = pdfFont.pdfMake.vfs

//window.JSZip = jsZip
window.$ = jquery
window._ = _
window.Swal = Swal
window.axios = axios
window.bootstrap = bootstrap
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const csrf_token = document.head.querySelector('meta[name="csrf-token"]')
if (csrf_token) {
	window.csrf_token = csrf_token.content
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token
} else
	console.error(
		'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
	)
