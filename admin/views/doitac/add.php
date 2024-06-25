<h4 class="text-primary font-weight-bold">Thêm mới đối tác</h4>
<form action="index.php?controller=doitac&action=add_submit" method="post" class="was-validated">
    <div class="form-group">
        <label>Tên đối tác:</label>
        <input type="text" class="form-control" id="name_doitac" name="name_doitac" >
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="text" class="form-control" id="email_doitac" name="email_doitac" >
    </div>
    <div class="form-group">
        <label>Phone:</label>
        <input type="phone" class="form-control" id="phone_doitac" name="phone_doitac">
    </div>
    <div class="form-group">
        <label>Địa Chỉ:</label>
        <input type="adress" class="form-control" id="address_doitac" name="address_doitac">        
    </div>
    <div class="form-group">
        <label>Website:</label>
        <input type="text" class="form-control" id="website_doitac" name="website_doitac">
    </div>
    <button type="submit" class="btn btn-primary" name="add">Thêm</button>
</form>