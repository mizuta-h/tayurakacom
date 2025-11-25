jQuery(function($){

	/**
	 * モーダルCTA 閉じる
	 */
	$('#js-modal-cta .p-modal-cta__close').on('click', function() {
		var $modal_cta = $('#js-modal-cta');
		$modal_cta.removeClass('is-active');
		setTimeout(function(){
			$modal_cta.remove();
		}, 1000);
	});

	$(document).on('click', function(event){
		if($('#js-modal-cta').hasClass("is-active")){
			if(!$(event.target).closest('.p-modal-cta__inner').length){
				$('#js-modal-cta').removeClass("is-active");
				setTimeout(function(){
					$('#js-modal-cta').remove();
				}, 1000);
			}
		}
	});


});
