<?php $__env->startSection('subpagestyle'); ?>
	<style>
	/*	body {
		  font-family: 'open sans';
		  overflow-x: hidden; }*/

		img {
		  max-width: 100%; }

		.preview {
		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-orient: vertical;
		  -webkit-box-direction: normal;
		  -webkit-flex-direction: column;
		      -ms-flex-direction: column;
		          flex-direction: column; }
	/*	  @media  screen and (max-width: 996px) {
		    .preview {
		      margin-bottom: 20px; } }*/

		.preview-pic {
		  -webkit-box-flex: 1;
		  -webkit-flex-grow: 1;
		      -ms-flex-positive: 1;
		          flex-grow: 1; }

		.preview-thumbnail.nav-tabs {
		  border: none;
		  margin-top: 15px; }
		  .preview-thumbnail.nav-tabs li {
		    width: 18%;
		    margin-right: 2.5%; }
		    .preview-thumbnail.nav-tabs li img {
		      max-width: 100%;
		      display: block; }
		    .preview-thumbnail.nav-tabs li a {
		      padding: 0;
		      margin: 0; }
		    .preview-thumbnail.nav-tabs li:last-of-type {
		      margin-right: 0; }

		.tab-content {
		  overflow: hidden; }
		  .tab-content img {
		    width: 100%;
		    -webkit-animation-name: opacity;
		            animation-name: opacity;
		    -webkit-animation-duration: .3s;
		            animation-duration: .3s; }

		.card {
		  margin-top: 10px;
		  background: #eee;
		  padding: 1em;
		  line-height: 1.5em; }

/*		@media  screen and (min-width: 997px) {
		  .wrapper {
		    display: -webkit-box;
		    display: -webkit-flex;
		    display: -ms-flexbox;
		    display: flex; } }*/

		.details {
		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -ms-flexbox;
		  display: flex;
		  -webkit-box-orient: vertical;
		  -webkit-box-direction: normal;
		  -webkit-flex-direction: column;
		      -ms-flex-direction: column;
		          flex-direction: column; }

		.colors {
		  -webkit-box-flex: 1;
		  -webkit-flex-grow: 1;
		      -ms-flex-positive: 1;
		          flex-grow: 1; }

		.product-title, .price, .sizes, .colors {
		  text-transform: UPPERCASE;
		  font-weight: bold; }

		.checked, .price span {
		  color: #ff9f1a; }

		.product-title, .rating, .product-description, .price, .vote, .sizes {
		  margin-bottom: 5px; }

		.product-title {
		  margin-top: 0; }

		.size {
		  margin-right: 10px; }
		  .size:first-of-type {
		    margin-left: 10px; }

	/*	.color {
		  display: inline-block;
		  vertical-align: middle;
		  margin-right: 10px;
		  height: 2em;
		  width: 2em;
		  border-radius: 2px; }
		  .color:first-of-type {
		    margin-left: 20px; }*/

		.add-to-cart, .like {
			/*position: absolute;
			bottom: 10px;*/
		  background: #ff9f1a;
		  padding: 1.2em 1.5em;
		  border: none;
		  text-transform: UPPERCASE;
		  font-weight: bold;
		  color: #fff;
		  -webkit-transition: background .3s ease;
		          transition: background .3s ease; }

		  .add-to-cart:hover, .like:hover {
		    background: #b36800;
		    color: #fff; }

		.not-available {
		  text-align: center;
		  line-height: 2em; }
		  .not-available:before {
		    font-family: fontawesome;
		    content: "\f00d";
		    color: #fff; }

		.orange {
		  background: #ff9f1a; }

		.green {
		  background: #85ad00; }

		.blue {
		  background: #0076ad; }

		.tooltip-inner {
		  padding: 1.3em; }

	/*	@-webkit-keyframes opacity {
		  0% {
		    opacity: 0;
		    -webkit-transform: scale(3);
		            transform: scale(3); }
		  100% {
		    opacity: 1;
		    -webkit-transform: scale(1);
		            transform: scale(1); } }*/

	/*	@keyframes  opacity {
		  0% {
		    opacity: 0;
		    -webkit-transform: scale(3);
		            transform: scale(3); }
		  100% {
		    opacity: 1;
		    -webkit-transform: scale(1);
		            transform: scale(1); } }*/

	/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 60%;
        width: 50%;
      }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($seller_id>0): ?>
	<div>
		<p>Elenco prodotti del negozio con id <?php echo e($seller_id); ?>: &nbsp</p>
	</div>
<?php endif; ?>

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?php echo e($product['imgProfilo']); ?>"/></div>
		<!--			  <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
						</div> -->
		<!--				<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						</ul>  -->
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo e($product['titolo']); ?></h3>
				<!--		<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div> -->
						<p class="product-description"><?php echo e($product['provenienza']); ?></p>
						<h4 class="price">prezzo: <span><?php echo e($product['prezzo']); ?></span></h4>
				<!--		<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
		<!--				<h5 class="sizes">sizes:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
						</h5> -->
		<!--				<h5 class="colors">colors:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
						</h5> -->
						<div class="action">
							<button class="add-to-cart btn btn-default" type="button">Agg. al carrello</button>
					<!--		<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/frontend/partials/navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>