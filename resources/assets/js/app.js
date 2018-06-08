
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');
require( 'datatables.net-bs' );
require('datatables.net-bs/css/dataTables.bootstrap.css')

window.dt_lang_catalan = {
	sProcessing:   'Processant...',
	sLengthMenu:   'Mostra _MENU_ registres',
	sZeroRecords:  'No s\'han trobat registres.',
	sInfo:         'Mostrant de _START_ a _END_ de _TOTAL_ registres',
	sInfoEmpty:    'Mostrant de 0 a 0 de 0 registres',
	sInfoFiltered: '(filtrat de _MAX_ total registres)',
	sInfoPostFix:  '',
	sSearch:       'Filtrar:',
	sUrl:          '',
	oPaginate: {
		sFirst:    'Primer',
		sPrevious: 'Anterior',
		sNext:     'Següent',
		sLast:     'Últim'
	}
};
