
    <div class="row">

      <div class="col-lg-3">

        <h3 class="my-4">Магазин</h3>
        <div class="list-group">
		<?php
			foreach ($get_category as $key => $value) {
			    $active = ($cId == $value->id) ? "active" : ""; ?>
				<a href="/category?cId=<?=$value->id?>" class="list-group-item <? echo $active; ?>"><?=$value->name?></a>
			<?}
		?>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

          <div class="row  my-4">

              <?php
              if(empty($products)) {
                  echo '<div class="col-lg-4 col-md-6 mb-4">Данная категория пустая</div>';
              }
              foreach($products as $row) {
                  ?>
              <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100">
                      <?
                       $url_photo = (empty($row->photo)) ? "" : '<a href=""><img class="card-img-top" src="'.$row->photo.'" alt=""></a>';
                       echo $url_photo;
                      ?>
                      <div class="card-body">
                          <h4 class="card-title">
                              <a href="#"><? echo $row->name; ?></a>
                          </h4>
                          <p class="card-text"><? echo $row->description; ?></p>
                      </div>
                  </div>
              </div>
                  <?
              }
              ?>

          </div>
          <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->