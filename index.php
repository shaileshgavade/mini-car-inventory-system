<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mini car inventory system</title>
        <link rel="stylesheet" href="css/jquery-ui.css"></link>
<!--        <link rel="stylesheet" href="css/jquery-ui.structure.min.css"></link>
        <link rel="stylesheet" href="css/jquery-ui.theme.min.css"></link>-->
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/mdb.min.css">
        <link rel="stylesheet" href="css/toastr.css">
        <link rel="stylesheet" href="css/custom-style.css">

    </head>
    <body class="container-fluid">
        <div class="card">
            <div class="card-body text-center bg-light">
                Car Inventory
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="manufacturer-tab-md" data-toggle="tab" href="#manufacturer-md" role="tab" aria-controls="manufacturer-md"
                      aria-selected="true">Manufacturer</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="model-tab-md" data-toggle="tab" href="#model-md" role="tab" aria-controls="model-md"
                      aria-selected="false">Model</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="inventory-tab-md" data-toggle="tab" href="#inventory-md" role="tab" aria-controls="inventory-md"
                      aria-selected="false">Inventory</a>
                  </li>
                </ul>
                <div class="tab-content card pt-5" id="myTabContentMD">
                    <div class="tab-pane fade p-2 show active" id="manufacturer-md" role="tabpanel" aria-labelledby="manufacturer-tab-md">
                        <form id="addManufacturer">
                            <div class="form-group">
                                <label for="name">Add Manufacturer</label>
                                <input type="text" name="name" class="form-control" id="manufacturerName" placeholder="Enter name">
                            </div>
                            <button type="submit" id="addManufacturerBtn" class="btn btn-primary">ADD</button>
                        </form>
                    </div>
                    <div class="tab-pane fade p-2" id="model-md" role="tabpanel" aria-labelledby="model-tab-md">

                        <form id="addModel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="modelName">Model Name</label>
                                        <input type="text" name="modelName" class="form-control" id="modelName" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Manufacturer</label>
                                        <!--<input type="text" name="manufacturer" class="form-control" id="modelName" placeholder="Enter name">-->
                                        <select name="modelManufacturer" class="browser-default custom-select custom-select mb-3" id="manufacturers-options">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="modelName">Manufacturig Year</label>
                                    <select name="modelYear" class="browser-default custom-select custom-select mb-3" id="modelYears">
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="modelName">Registration Number</label>
                                    <input type="text" name="modelNumber" class="form-control" id="modelNumber" placeholder="Enter number">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="modelName">Color</label>
                                    <input type="text" name="modelColor" class="form-control" id="modelColor" placeholder="Enter color">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="modelName">Note</label>
                                    <input type="text" name="modelNote" class="form-control" id="modelNote" placeholder="Enter note">
                                </div>
                            </div>
                            <button type="submit" id="addModelBtn" class="btn btn-primary">ADD</button>
                        </form>

                    </div>
                  <div class="tab-pane fade p-2" id="inventory-md" role="tabpanel" aria-labelledby="inventory-tab-md">
                      <table id="inventory" style="width: 100%;">
                        <thead>
                          <th>Sr. No</th>
                          <th>Model</th>
                          <th>Manufacturer</th>
                          <!--<th>Count</th>-->
                        </thead>
                        <tbody>
                          <tr></tr>
                          <tr></tr>
                          <tr></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Car Model Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="model-details" class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td>Modal name</td>
                                    <td class="modal-name"></td>
                                </tr>
                                <tr>
                                    <td>Manufacturer name</td>
                                    <td class="manufacturer-name"></td>
                                </tr>
                                <tr>
                                    <td>Manufacturing year</td>
                                    <td class="manufacturer-year"></td>
                                </tr>
                                <tr>
                                    <td>Registration number</td>
                                    <td class="registration-number"></td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td class="color"></td>
                                </tr>
                                <tr>
                                    <td>Note</td>
                                    <td class="note"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="model-sold">Sold</button>
                        <input type="hidden" id="car-model-id" value=""/>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/custom.js"></script>
</html>