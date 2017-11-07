<!DOCTYPE html>
<html>
<head>
	<title>AngularJs CRUD</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <style type="text/css">
    .table-sortable tbody tr 
    {
        cursor: move;
     }

    </style>
    <script type="text/javascript">
		$(document).ready(function() 
		{
			$("#add_row").on("click", function() {
			// Dynamic Rows Code

			// Get max row id and set new id
			var newid = 0;
			$.each($("#tab_logic tr"), function() {
			if (parseInt($(this).data("id")) > newid) {
			newid = parseInt($(this).data("id"));
			}
			});
			newid++;

			var tr = $("<tr></tr>", {
			id: "addr"+newid,
			"data-id": newid
			});
			// loop through each td and create new elements with name of newid
			$.each($("#tab_logic tbody tr:nth(0) td"), function() {
			var cur_td = $(this);
			var children = cur_td.children();
			// add new td and element if it has a nane
			if ($(this).data("name") != undefined) {
			var td = $("<td></td>", {
			"data-name": $(cur_td).data("name")
			});

			var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
			c.attr("name", $(cur_td).data("name") + newid);
					if ($(this).data("name") == 'submit') {
						c.attr("value", 'insert');

					}
			c.appendTo($(td));
			td.appendTo($(tr));
			} else {
			var td = $("<td></td>", {
			'text': $('#tab_logic tr').length
			}).appendTo($(tr));
			}
			});

			// add delete button and td
			/*
			$("<td></td>").append(
			$("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
			.click(function() {
			$(this).closest("tr").remove();
			})
			).appendTo($(tr));
			*/

			// add the new row
			$(tr).appendTo($('#tab_logic'));

			$(tr).find("td button.row-remove").on("click", function() {
			$(this).closest("tr").remove();
			});
			});




			// Sortable Code
			var fixHelperModified = function(e, tr) {
			var $originals = tr.children();
			var $helper = tr.clone();

			$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
			});

			return $helper;
			};

			$(".table-sortable tbody").sortable({
			helper: fixHelperModified      
			}).disableSelection();

			$(".table-sortable thead").disableSelection();



			///$("#add_row").trigger("click");
		});
    </script>
</head>
<body>


<div class="container" ng-app="myapp" ng-controller="mycontroller">
	<div   ng-init="show_data()">
    <div class="row clearfix">
    	<h2 class="text-center">AngularJs CRUD:</h2>
    	<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							Name
						</th>
						<th class="text-center">
							Email
						</th>
						<th class="text-center">
							Age
						</th>
    					<th class="text-center">
							Option
						</th>
        				<th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
						</th>
					</tr>
				</thead>
				<tbody>
    				<tr id='addr0' data-id="0" >
						<td data-name="name">
						    <input type="text" name='name' ng-model="name"  placeholder='Name' class="form-control"/>
						</td>
						<td data-name="mail">
						    <input type="text" name='email' ng-model="email" placeholder='Email' class="form-control"/>
						</td>
						<td data-name="desc">
						    <input type="text" name='age' ng-model="age" placeholder='Age' class="form-control"/>
						 
						</td>
    					<td data-name="gender">
						    <select name="gender" ng-model="gender" class="form-control">
        				        <option value"">Select gender</option>
    					        <option value"male">Male</option>
        				        <option value"female">Female</option>
						    </select>
						</td>
                        <td data-name="del">
                            <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
                        </td>
                        <td data-name="submit">
                        	   <input type="hidden" ng-model="id">
                           <input type="submit" name="submit" class="btn btn-primary" value="{{btnname}}" ng-click="insert()">
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<a id="add_row" class="btn btn-default pull-right">Add Row</a>
</div>



<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">
		<div>
			<h2 class="text-center">Added Users:</h2>
			<table class="table table-bordered">
		 	<tr>
		 		<th>Se.no</th>
		 		<th>Name</th>
		 		<th>Email</th>
		 		<th>Age</th>
		 		<th>gender</th>
		 		<th>Edit</th>
		 		<th>Delete</th>
		 	</tr>
		 	  <tr ng-repeat="x in users">
		 		<td>{{x.id}}</td>
		 		<td>{{x.name}}</td>
		 		<td>{{x.email}}</td>
		 		<td>{{x.age}}</td>
		 		<td>{{x.gender}}</td>
		 		<td>
		 			<button class="btn btn-primary" ng-click="update_data(x.id,x.name,x.email,x.age)">
		 				<span 	class="glyphicon glyphicon-edit"></span>Edit
		 			</button>
		 		</td>
		 		<td>
		 			<button class="btn btn-danger" ng-click="delete_data(x.id)">
		 				<span 	class="glyphicon glyphicon-trash"></span>Delete
		 			</button>
		 		</td>
		 	</tr>
		 </table>
		</div>
		
	</div>
</div>



<script type="text/javascript">
	var app = angular.module('myapp',[]);
	app.controller('mycontroller',function($scope,$http){
        $scope.btnname = 'insert';
        $scope.insert = function(){
        	$http.post("insert.php",{'id':$scope.id,'name':$scope.name,'email':$scope.email,'age':$scope.age,'gender':$scope.gender,'btnname':$scope.btnname})
        	.then(function successCallback(response){
                    if(response.data.status)
					{
						alert(response.data.msg);
						//$scope.msg = "Inserted Successfully";
						$scope.name="";
				    	$scope.email ="";
				    	$scope.age = "";
				    	$scope.gender = "";
				    	$scope.btnname = "insert";
					    $scope.show_data();
					}
					else
					{
						alert(response.data.msg);
					}
        	   })
             }

     //Display all records from database
        $scope.show_data = function(){
			 $http({
			  method: 'get',
			  url: 'display.php'
			 }).then(function successCallback(response) {
			  $scope.users = response.data;
			 });
        }

      //update existing user
        $scope.update_data = function(id, name,email,age,gender){
        	$scope.id = id;
        	$scope.name = name;
        	$scope.email = email;
        	$scope.age = age;
        	$scope.gender = gender;
        	$scope.btnname = 'update';
        }  


      //update existing user
		$scope.delete_data = function(id)
		{
			if(confirm('Are Sure...'))
			{
				$http.post("delete.php",{'id':id})
				.then(function(response){						
					$scope.show_data();
					alert(response.data.msg);
				});
			}
			else
			{
				return false;
			}
		}
	});
</script>
</body>
</html>