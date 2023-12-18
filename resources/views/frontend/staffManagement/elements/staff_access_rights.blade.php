<div id="staff_access_rights" class="tab-pane">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="prf-contacts">
                <h2> <span><i class="fa fa-map-marker"></i></span> Location <a href="javascript:void(0)" class="staff_location-edit-btn" clmn-name="current_location"><i class="fa fa-pencil profile"></i> </a> </h2>
                <div class="location-info current_location"><p></p></div>

                <div class="location-info ">    
                    <strong style="color:#3399CC;">Previous Location</strong><br>
                    <div class="previous_location"><p></p></div>
                    
                </div>
                <h2> <span><i class="fa fa-phone"></i></span> contacts <a href="javascript:void(0)" class="staff-contact-edit-btn" phone_no="{{ $staff_member->phone_no }}" email="{{ $staff_member->email }}"><i class="fa fa-pencil profile"></i></a> </h2>
                <div class="location-info">
                    <p><strong style="color:#3399CC;">Phone</strong> :  <br>
                        <br>
                        <strong style="color:#3399CC;">Email</strong> : <br>
                        <br>
                        <strong style="color:#3399CC;">Facebook</strong> :<br>
                        <strong style="color:#3399CC;">Twitter</strong> :                                     
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div id="map-canvas"></div>
        </div>
    </div>
</div>




