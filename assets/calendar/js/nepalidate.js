var ST = jQuery.noConflict();
	ST(document).ready(function(){
            ST('#nepaliDate1').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate2').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate4').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-primary btn-lg'
		});
		ST('#deadline').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-primary btn-lg deadline-date hidden'
		});
			ST('#nepaliDate5').nepaliDatePicker({
				selectedid: 'nepaliDate5',
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-primary btn-lg'
		});
                ST('#nepaliDate6').nepaliDatePicker({

			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-primary btn-lg'
		});
                ST('#nepaliDate7').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-primary btn-lg'
		});
                ST('#nepaliDate8').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		ST('#nepaliDate9').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate10').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate11').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate12').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate13').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate14').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
                ST('#nepaliDate15').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		     ST('#nepaliDate16').nepaliDatePicker({
			onFocus: true,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: false,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		 ST('#nepaliDate25').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		 ST('#nepaliDate26').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		 ST('#nepaliDate27').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'
		});
		ST('#nepaliDate').nepaliDatePicker({
			ndpEnglishInput: 'englishDate'
		});

		ST('#nepaliDate2').nepaliDatePicker();
		ST('#nepaliDate3').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'Date',
			ndpTriggerButtonClass: 'btn btn-primary btn-sm'

		});


		ST('#englishDate').change(function(){
			ST('#nepaliDate').val(AD2BS(ST('#englishDate').val()));
		});

		ST('#englishDate9').change(function(){
			ST('#nepaliDate9').val(AD2BS(ST('#englishDate9').val()));
		});

		ST('#nepaliDate9').change(function(){
			ST('#englishDate9').val(BS2AD(ST('#nepaliDate9').val()));
		});

	});
