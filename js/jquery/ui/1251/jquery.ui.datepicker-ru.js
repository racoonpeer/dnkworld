jQuery(function($){
	$.datepicker.regional['ru'] = {
		closeText: '�������',
		prevText: '&#x3c;����',
		nextText: '����&#x3e;',
		currentText: '�������',
		monthNames: ['������','�������','����','������','���','����','����','������','��������','�������','������','�������'],
		monthNamesShort: ['���','���','���','���','���','���','���','���','���','���','���','���'],
		dayNames: ['�����������','�����������','�������','�����','�������','�������','�������'],
		dayNamesShort: ['���','���','���','���','���','���','���'],
		dayNamesMin: ['��','��','��','��','��','��','��'],
		dateFormat: 'dd.mm.yy', 
		firstDay: 1,
		isRTL: false};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
});