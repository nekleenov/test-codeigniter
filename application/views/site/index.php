    <div class="row">

      <div class="col-lg-3">

        <h3 class="my-4">Магазин</h3>
        <div class="list-group">
		<?php
			foreach ($get_category as $key => $value) { ?>
				<a href="/category?cId=<?=$value->id?>" class="list-group-item"><?=$value->name?></a>
			<?}
		?>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->