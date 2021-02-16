var accounts_count = 0;
$(document).on('click','.addAccount',function(){          
     accounts_count += 1;
     if (accounts_count >= 10) return;
     var accounts = '<div class="row"> <div class="col-xs-3"> <div class="form-group"> <label>Additional Account </label> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-phone"></i> </span> <select class="form-control" name="social_account_name[]"> <option value="">Social Acc.</option> <option>Instagram</option> <option>Twitter</option> <option>LINE</option> <option>WeChat</option> <option>Kik</option> <option>Pinterest</option> </select> </div> </div> </div> <div class="col-xs-8"> <div class="form-group"> <label>Account ID</label> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-phone"></i> </span> <input type="text" placeholder="Account Id" class="form-control" name="social_account_id[]"> </div> </div> </div> <div class="col-xs-1"> <div class="form-group"> <button type="button" class="btn btn-primary pull-right addAccount"> <i class="fa fa-plus"></i> </button> </div> </div> </div>';
     $('#accounts').append(accounts);
});