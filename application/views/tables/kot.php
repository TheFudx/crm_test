   
<style>

.toggle-btn {
	width: 80px;
	height: 40px;
	margin: 10px;
	border-radius: 50px;
	display: inline-block;
	position: relative;
	background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAyklEQVQ4T42TaxHCQAyENw5wAhLACVUAUkABOCkSwEkdhNmbpHNckzv689L98toIAKjqGcAFwElEFr5ln6ruAMwA7iLyFBM/TPDuQSrxwf6fCKBoX2UMIYGYkg8BLOnVg2RiAEexGaQQq4w9e9klcxGLLAUwgDAcihlYAR1IvZA1sz/+AAaQjXhTQQVoe2Yo3E7UQiT2ijeQdojRtClOfVKvMVyVpU594kZK9zzySWTlcNqZY9tjCsUds00+A57z1e35xzlzJjee8xf0HYp+cOZQUQAAAABJRU5ErkJggg==") no-repeat 50px center #e74c3c;
	cursor: pointer;
	-webkit-transition: background-color 0.4s ease-in-out;
	-moz-transition: background-color 0.4s ease-in-out;
	-o-transition: background-color 0.4s ease-in-out;
	transition: background-color 0.4s ease-in-out;
	cursor: pointer;
}

.toggle-btn.active {
	background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAmUlEQVQ4T6WT0RWDMAhFeZs4ipu0mawZpaO4yevBc6hUIWLNd+4NeQDk5sE/PMkZwFvZywKSTxF5iUgH0C4JHGyF97IggFVSqyCFga0CvQSg70Mdwd8QSSr4sGBMcgavAgdvwQCtApvA2uKr1x7Pu++06ItrF5LXPB/CP4M0kKTwYRIDyRAOR9lJTuF0F0hOAJbKopVHOZN9ACS0UgowIx8ZAAAAAElFTkSuQmCC") no-repeat 10px center #2ecc71;
}

.toggle-btn.active .round-btn {
	left: 45px;
}

.toggle-btn .round-btn {
	width: 30px;
	height: 30px;
	background-color: #fff;
	border-radius: 50%;
	display: inline-block;
	position: absolute;
	left: 5px;
	top: 50%;
	margin-top: -15px;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

.toggle-btn .cb-value {
	position: absolute;
	left: 0;
	right: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	z-index: 9;
	cursor: pointer;
}
.bell_container{
  position: absolute;
  right: 0;
  transform: translate(-10px, -50px);
}
.bell_container i{
  font-size: 29px;
  transform: translate(0px, -20px);
  color: rgba(0,0,0,.5);
}
.dishlist.custom-control-input:checked~.custom-control-label::before {
    color: #fff;
    border-color: #c30707 !important;
    background-color: #c30707 !important;
    box-shadow: none;
}

.dishlist.custom-checkbox .custom-control-input:checked~.custom-control-label::after {
	content: "\f00d "
}
.far{
	font-weight: 900;
}
.fa-mug-hot,.fa-utensils{
	color: black;
}
.sidebar-dark-primary{
    background-color: #051135 !important;
}
</style>
    
    <div class="legend">
      <span class="legend-span"><i class="fas fa-circle " style="color: #ffba2f;"></i>  New order</span>
      <span class="legend-span"><i class="fas fa-circle  " style="color: #317bf6;"></i>  In Cooking</span>
      <span class="legend-span"><i class="fas fa-circle " style="color: #22b07e;"></i> Order Ready</span>
    </div>
    <div class="bell_container">
      <i class=" fa fa-bell" id="bell" aria-hidden="true"></i>
    <div class="toggle-btn active">
      <input type="checkbox"  name="bellBtn" value="checked"  checked class="cb-value" />
      <span class="round-btn"></span>
    </div>
    </div>
    
    

    <section class="content">
        <div class="container-fluid">
            <div class="row p-2" id="kot_data">
            </div>
        </div>
    </section>
    <script>
      var restaurant_id = <?= ($restaurant_id ?? 0); ?>;
    </script>