<body class="app">
    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Thêm Người Dùng</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
								<div class="col-auto">
								    <a class="btn app-btn-secondary bg-danger text-white" href="index.php?controller=customer">
									    Trở Lại</a>
							    </div>
							</div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
				<div class="card-body">
					<form method="post" action="index.php?controller=customer&action=store">
					<div class="mb-3">
							<label class="form-label">Họ Và Tên</label>
							<input class="form-control"  name="fullname" type="text" placeholder="Full Name">
		
						</div>
						<div class="mb-3">
							<label class="form-label">Tên Người Dùng</label>
							<input class="form-control"  name="username" type="text" placeholder="User Name">
		
						</div>
						<div class="mb-3">
							<label class="form-label" for="exampleInputPassword1">Mật Khẩu</label>
							<input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password">
						</div>
						<div class="mb-3">
							<label>Địa Chỉ Email</label>
							<input class="form-control"  name="email" type="email" placeholder="Email">
		
						</div>
						<div class="mb-3">
							<label>Số Điện Thoại</label>
							<input class="form-control"  name="phone" type="text" placeholder="Phone">
		
						</div>
						<div class="mb-3">
							<label>Vai Trò</label>
							<select class="form-control" name="role">
								<option value="admin">Admin </option>
								<option value="user">User </option>
							</select>
						</div>
		
						<button class="btn btn-primary text-white fs-5" name="submit" type="submit">Add User</button>
		
					</form>
				</div>
			</div>
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->	    
    <!--//app-wrapper-->  				
</body>

