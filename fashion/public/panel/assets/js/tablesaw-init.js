/*! Tablesaw - v2.0.3 - 2016-05-02
* https://github.com/filamentgroup/tablesaw
* Copyright (c) 2016 Filament Group; Licensed MIT */
;(function( $ ) {

	// DOM-ready auto-init of plugins.
	// Many plugins bind to an "enhance" event to init themselves on dom ready, or when new markup is inserted into the DOM
	$( function(){
		$( document ).trigger( "enhance.tablesaw" );
	});
	
	Tablesaw.i18n.modes = ['انباشته', 'جابجایی افقی', 'انتخابی'];
	Tablesaw.i18n.columns = 'نمایش ستون ها';
	Tablesaw.i18n.columnBtnText = 'نمایش ستون ها';
	Tablesaw.i18n.sort = 'ترتیب';
	Tablesaw.i18n.columnsDialogError = 'ستون واجد شرایطی وجود ندارد.';

})( jQuery );