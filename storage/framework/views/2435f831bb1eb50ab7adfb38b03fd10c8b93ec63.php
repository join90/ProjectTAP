<?php 

/*$prodotti= array("Pomodoro Pachino","Albicocche di Monterosso","Limoni di Francofonte","Melanzane", "Spinaci","Arance di Franconfonte", "Zucchine dell'Etna","Giallo di Paceco");
*/
$quantities=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
shuffle($products);


 ?>

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

		.btn {
			position: absolute;
    		right: 50px;		}      
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php for($idx=0; $idx<5; $idx++): ?>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">		
					<div class="details col-md-12">
						<h3 class="product-title"><?php echo e($products[$idx]['titolo']); ?></h3>
						<p class="product-description">Quantità 
							<?php
							$quant=array_rand($quantities, 1); 
							echo $quant;
							?>
						</p>
						<h4 class="price">Importo: <span> €
								<?php								 
								echo $quant*$products[$idx]['prezzo'];
								?>
							</span></h4>				
						</div>
					</div>
				</div>
			</div>			
		</div>	
<?php endfor; ?>

<div>
	<p>&nbsp;&nbsp;</p>
		<button class="add-to-cart btn" type="button">Procedi all'acquisto</button>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/frontend/partials/navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>