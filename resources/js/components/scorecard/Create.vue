<template>
    <div>
         <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5" style="margin-top: 10px;">
                        <h5 class="card-title">Create Score Card</h5>
                    </div>
                    <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                        <div class="btn btn-info" data-toggle="modal" data-target="#default">Save <i class="la la-disc"></i></div>
                    </div>
                </div>
                <div class="" style="">
                    <div class="row">
                        <div class="input-group mb-3 col-lg-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Name</label>
                            </div>
                            <select v-if="user['role']==2" class="custom-select" required name="officer_name[]" id="inputGroupSelect01">
                                <option value="">Choose...</option>
                                <option v-for="user in staff" :key="user.id" :value="user.id"> {{ user.name }}</option>
                            </select>
                            <select v-else-if="user['role']==1" class="custom-select" required name="officer_name[]" id="inputGroupSelect01">
                                <option value="">Choose...</option>
                                <option v-for="staff in entire_staff" :key="staff.id" :value="staff.id">{{ staff.name }}</option>
                            </select>
                            <div class="invalid-feedback text-right">Choose officer Name</div>
                        </div>
                        <div class="input-group mb-3 col-lg-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect02">Month</label>
                            </div>
                            <select class="custom-select" required name="monthRate[]" id="">
                                <option value="">Choose...</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                            <div class="invalid-feedback text-right">Pick a month</div>
                        </div>
                        <div class="input-group mb-3 col-lg-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Year</label>
                            </div>
                            <select class="custom-select" required name="yearRate[]" id="">
                                <option value="">Choose...</option> 
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered " id="scorecard">
                    <thead class="thead table-success">
                        <tr>
                            <th>Objective</th>
                            <th>Measure</th>
                            <th>Metric</th>
                            <th>Weight %</th>
                            <th>Target</th>
                        </tr>
                    </thead>
                    <tbody> 
                            <tr v-for="objective_1 in cast_objectives" :key="objective_1.id" style="background-color:#343a40; color:#fff !important;">
                                    <td colspan="5"><h4 style="color:#fff !important;">{{ objective_1.description}}</h4></td>
                                    
                                    <tr v-for="objective_2 in objective_1.objectives" :key="objective_2.id">
                                        <td><h6 style="margin-left: 20px;">{{ objective_2.description }}</h6></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <tr v-for="objective in objective.objectives" :key="objective.id">
                                            
                                            <td></td>
                                            <td>{{ objective.objectives.measures.description }}</td>
                                            <div v-for="(objective, index) in objective.objectives" :key="objective.id">
                                                <td>{{ objective.objectives.measures.metrics.description  }}</td>
                                                <td><input style="height: 20px;" class="form-control" type="text" required></td>
                                                <td><input style="height: 20px; width: 100px;" class="form-control" type="text" required></td>
                                            
                                                <tr v-if="index!=objective.objectives.measures.metrics.length-1"><td></td><td></td></tr>
                                            </div>
                                        </tr> -->
                                    </tr>
                        
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
         <!-- Modal 
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Add Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('add.department') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department">Department Name</label>
                                        <input id="description" name="description" class="form-control" placeholder="Enter department name" type="text" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn danger btn-outline-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn success btn-outline-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  -->
    </div>
</template>
<script>
export default {
    props: ["user","staff","entire_staff","objectives"],
    data() {
        return {
            cast_user:null,
            cast_staff:null,
            cast_entire_staff:null,
            cast_objectives:null
        }
    },
    created() {
        this.cast_user = JSON.parse(this.user);
        this.cast_staff = JSON.parse(this.staff);
        this.cast_entire_staff = JSON.parse(this.entire_staff);
        this.cast_objectives = JSON.parse(this.objectives);
    }
}
</script>