<h4 class="text-primary font-weight-bold">Sửa thông tin đối tác</h4>
<form action="index.php?controller=doitac&action=edit_submit" method="post" class="was-validated">
    <div class="form-group">
        <label>Mã đối tác:</label>
        <input type="text" class="form-control" id="id_doitac" name="id_doitac" value="<?php echo $doitac->id_doitac ?>" readonly>
    </div>
    <div class="form-group">
        <label>Tên đối tác:</label>
        <input type="text" class="form-control" id="name_doitac" name="name_doitac" value="<?php echo $doitac->name_doitac ?>" readonly>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="text" class="form-control" id="email_doitac" name="email_doitac" value="<?php echo $doitac->email_doitac ?>" required> 
    </div>
    <div class="form-group">
        <label>Phone:</label>
        <input type="phone" class="form-control" id="phone_doitac" name="phone_doitac" value="<?php echo $doitac->phone_doitac ?>" required>
    </div>
    <div class="form-group">
        <label>Địa Chỉ:</label>
        <input type="address" class="form-control" id="address_doitac" name="address_doitac" value="<?php echo $doitac->address_doitac ?>" required>     
    </div>
    <div class="form-group">
        <label>Website:</label>
        <input type="text" class="form-control" id="website_doitac" name="website_doitac" value="<?php echo $doitac->website_doitac ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="edit">Sửa</button>
</form>
