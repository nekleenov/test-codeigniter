<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Товары</h1>
    </div>
    <!-- /.col-lg-12 -->

    <div class="panel panel-default">
        <div class="panel-heading">
            Список всех категорий / <a href="/admin/category/add">Добавить категорию</a>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Название</th>
                    <th width="200">Опции</th>
                </tr>
                </thead>
                <tbody>
                <?
                    foreach($get_category AS $row) {
                        ?>
                        <tr>
                            <td><? echo $row->id; ?></td>
                            <td><? echo $row->name; ?></td>
                            <td><a href="/admin/category/edit/<? echo $row->id; ?>"><i class="fa fa-edit"></i> Изменить</a> / <a href="/admin/category/?delete=<? echo $row->id; ?>"><i class="fa fa-trash"></i> Удалить</a> </td>
                        </tr>
                        <?
                    }
                ?>
                </tbody>
            </table>
        </div>

        </div>
    </div>

</div>
<!-- /.row -->