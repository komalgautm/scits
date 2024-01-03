@include('rotaStaff.components.header')


                <div class="col-lg-11">
                    <div class="row">
                        <!-- Top Bar Info Section Start Here -->
                       

                        <!-- Top Bar Info Section End Here -->
                        <!-- Working Pattern form start from here -->
                        <div class="container">
                            <div class="row working-time-pattern">
                                <div class="col-md-12">
                                    <div class="heading">
                                        <h3 class="head">Employee hub </h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="tab-btn">
                                            <ul class="nav nav-tabs nav-fill" id="myTab">
                                                <li class="nav-item"><a href="#tabOne" data-bs-toggle="tab"
                                                        class="link-nav">Employees</a></li>
                                                <!-- <li class="nav-item"><a href="#tabTwo" data-bs-toggle="tab"
                                                        class="link-nav">COVID-19 Vaccinated employees</a></li> -->
                                                <li class="nav-item"><a href="#tabThree" data-bs-toggle="tab"
                                                        class="link-nav active">Manage teams</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="tabOne">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex btn-s justify-content-between my-4">
                                                                <div class="" id="multiEmployee">
                                                                    <button type="button" onclick="multiEmployees()"
                                                                        class="add-employe">Add a new
                                                                        employee</button>
                                                                    <button type="button" class="add-mult-employe">Add
                                                                        multiple employees</button>
                                                                </div>



                                                                <div class="container remove-padding M-right"
                                                                    id="multiForm" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="follow-step">
                                                                                <ul class="employees-detail d-flex">
                                                                                    <li
                                                                                        class="Employees-details detail">
                                                                                        <span class="s-font">Employees
                                                                                            details</span>
                                                                                    </li>
                                                                                    <li class="Address-details detail"
                                                                                        id="bg1"
                                                                                        style="background-color: #fff; color: #999;">
                                                                                        <span class="s-font">Employee
                                                                                            type</span>
                                                                                    </li>
                                                                                    <li class="Employment-details detail"
                                                                                        id="bg2"
                                                                                        style="background-color: #fff; color: #999;">
                                                                                        <span class="s-font">Working
                                                                                            hours</span>
                                                                                    </li>
                                                                                    <li class="Employee-setup detail"
                                                                                        id="bg3"
                                                                                        style="background-color: #fff; color: #999;">
                                                                                        <span class="s-font">Annual
                                                                                            leave
                                                                                            entitlement</span>
                                                                                    </li>
                                                                                    <li class="done detail" id="bg4"
                                                                                        style="background-color: #fff; color: #999;">
                                                                                        <span
                                                                                            class="s-font">Summary</span>
                                                                                    </li>
                                                                                    <li class="done detail" id="bg5"
                                                                                        style="background-color: #fff; color: #999;">
                                                                                        <span class="s-font">Done</span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="row" id="form1">
                                                                                <div class="col-md-12">
                                                                                    <div class="employees-info">
                                                                                        <div
                                                                                            class="add-margin col-md-12">
                                                                                            <h5>Add a new employee</h5>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12"
                                                                                                id="showDiv">
                                                                                                <form
                                                                                                    class="employees-data"
                                                                                                    onsubmit="return validateform()">
                                                                                                    <div class="row">
                                                                                                        <label
                                                                                                            for="firstName"
                                                                                                            class="col-sm-2 col-form-label">First
                                                                                                            name</label>
                                                                                                        <div
                                                                                                            class="col-sm-3">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                id="firstName"
                                                                                                                aria-describedby="emailHelp"
                                                                                                                placeholder="First name">
                                                                                                            <p
                                                                                                                id="nameError">
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <label
                                                                                                            for="lastName"
                                                                                                            class="col-sm-2 col-form-label">Last
                                                                                                            name</label>
                                                                                                        <div
                                                                                                            class="col-md-3">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                id="lastName"
                                                                                                                placeholder="Last name">
                                                                                                            <p
                                                                                                                id="lastNamError">
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <label
                                                                                                            for="emailAdd"
                                                                                                            class="col-sm-2 col-form-label">Email</label>
                                                                                                        <div
                                                                                                            class="col-md-3">
                                                                                                            <input
                                                                                                                type="email"
                                                                                                                placeholder="Email"
                                                                                                                class="form-control"
                                                                                                                id="emailAdd"
                                                                                                                value="">
                                                                                                            <p
                                                                                                                id="emailError">
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <label
                                                                                                            id="firstDate"
                                                                                                            class="col-sm-2 col-form-label">Employment
                                                                                                            start
                                                                                                            date</label>
                                                                                                        <div
                                                                                                            class="col-md-3">
                                                                                                            <input
                                                                                                                type="date"
                                                                                                                class="form-control"
                                                                                                                id="firstDate">
                                                                                                            <p
                                                                                                                id="startDate">
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group col-md-3 d-flex align-items-center">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="next1"
                                                                                                            onclick="next({id:'next',form:'form',count:1})"
                                                                                                            class="save-btn">Next
                                                                                                            step</button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="saveBtn"
                                                                                                            onclick="closeMultiEmployee()"
                                                                                                            class="cancel_btn">cancel</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- <div class="col-md-12 my-4">
                                                                                    <form onsubmit="event.preventDefault();" class="add-empoly-form">
                                                                                        <div class="form-inline row">
                                                                                            <div class="form-group">
                                                                                                <label for="name">Sort By</label>
                                                                                                <div class="inline">
                                                                                                    <input type="text" id="name" placeholder="First name">
                                                                                                    <span class="search_icon"><i class="fa fa-search"
                                                                                                            aria-hidden="true"></i></span>
                                                                                                </div>
                                                                                                <button id="" onclick="showhide()" class="add-employ-btn"> Add
                                                                                                    new employee</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div> -->
                                                                            </div>
                                                                            <div class="container remove-padding">
                                                                                <div class="row" id="form2"
                                                                                    style="display:none;">
                                                                                    <div class="col-md-12">
                                                                                        <div class="address-detail">
                                                                                            <div class="row my-4">
                                                                                                <div class="col-md-12">
                                                                                                    <h5>Contract and
                                                                                                        full time
                                                                                                        employment
                                                                                                        details</h5>
                                                                                                </div>
                                                                                                <div class="row my-3">
                                                                                                    <div
                                                                                                        class="col-md-4">
                                                                                                        <div
                                                                                                            class="card-1 card-btn">
                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                class="radio_btn"
                                                                                                                name="radio-btn"
                                                                                                                checked>
                                                                                                            <div
                                                                                                                class="bg-color">
                                                                                                                <h5>Fixed,
                                                                                                                    full
                                                                                                                    or
                                                                                                                    part
                                                                                                                    time
                                                                                                                </h5>
                                                                                                                <p> Employees
                                                                                                                    on a
                                                                                                                    repeating
                                                                                                                    working
                                                                                                                    time
                                                                                                                    pattern
                                                                                                                    who
                                                                                                                    work
                                                                                                                    fixed,
                                                                                                                    predictable
                                                                                                                    number
                                                                                                                    of
                                                                                                                    hours
                                                                                                                    every
                                                                                                                    week
                                                                                                                    and
                                                                                                                    have
                                                                                                                    a
                                                                                                                    fixed
                                                                                                                    leave
                                                                                                                    entitlement
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-md-4">
                                                                                                        <div
                                                                                                            class="card-1 card-btn">
                                                                                                            <input
                                                                                                                type="radio"
                                                                                                                class="radio_btn"
                                                                                                                name="radio-btn">
                                                                                                            <div
                                                                                                                class="bg-color">
                                                                                                                <h5>Short
                                                                                                                    hours
                                                                                                                    or
                                                                                                                    variable
                                                                                                                </h5>
                                                                                                                <p>Employees
                                                                                                                    on a
                                                                                                                    contract
                                                                                                                    who
                                                                                                                    work
                                                                                                                    a
                                                                                                                    different
                                                                                                                    number
                                                                                                                    of
                                                                                                                    hours
                                                                                                                    or
                                                                                                                    days
                                                                                                                    from
                                                                                                                    week
                                                                                                                    to
                                                                                                                    week
                                                                                                                    (but
                                                                                                                    not
                                                                                                                    zero-hours
                                                                                                                    contracts)
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-4 my-3 d-flex justify-content-evenly">
                                                                                                    <div
                                                                                                        class="previous">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="back1"
                                                                                                            onclick="back({id:'back',form:'form',count:2})"
                                                                                                            class="previous_btn">Back</button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="continue_save">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            id="next2"
                                                                                                            onclick="next({id:'next',form:'form',count:2})">Next
                                                                                                            step
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="cancel">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            onclick="closeMultiEmployee()"
                                                                                                            class="cancel_btn">cancel</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <form action=""
                                                                                                    class="row contract-detaial"
                                                                                                    style="display: none;">
                                                                                                    <div
                                                                                                        class="form-group col-md-2">
                                                                                                        <label
                                                                                                            for="exampleInputEmail1">Name</label>
                                                                                                        <div
                                                                                                            class="name">
                                                                                                            <span>Sagar
                                                                                                                &nbsp
                                                                                                                Pawar</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group col-md-2 my-3">
                                                                                                        <label
                                                                                                            for="exampleInputEmail1">Entitlement
                                                                                                            unit
                                                                                                            in</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="exampleInputEmail1"
                                                                                                            aria-describedby="emailHelp"
                                                                                                            placeholder="">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group col-md-2 my-3">
                                                                                                        <label
                                                                                                            for="exampleInputLastname1"
                                                                                                            style="margin-bottom: 20px;">Full
                                                                                                            time annual
                                                                                                            leave
                                                                                                            entitlement
                                                                                                            equivalent</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="exampleInputLastname1"
                                                                                                            placeholder="">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group col-md-2 my-3">
                                                                                                        <label
                                                                                                            for="staticEmail">Leave
                                                                                                            year start
                                                                                                            date</label>
                                                                                                        <input
                                                                                                            type="email"
                                                                                                            placeholder=""
                                                                                                            class="form-control"
                                                                                                            id="staticEmail"
                                                                                                            value="">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group col-md-1">
                                                                                                        <label
                                                                                                            class="form-check-label">Copy</label>
                                                                                                        <p
                                                                                                            class="folder-icon">
                                                                                                            <i class="fa fa-folder-o"
                                                                                                                aria-hidden="true"></i>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-md-2 d-flex align-items-center justify-content-center">
                                                                                                        <button
                                                                                                            class="save-btn">save</button>
                                                                                                        <button
                                                                                                            class="cancel-btn">cancel</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="container remove-padding">
                                                                                <div class="row" id="form3"
                                                                                    style="display:none;">
                                                                                    <div class="col-md-12">
                                                                                        <div class="employment-details">
                                                                                            <div class="row my-4">
                                                                                                <div class="col-md-12">
                                                                                                    <h5>test's working
                                                                                                        hours</h5>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <form action="">
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <label
                                                                                                                for="firstName"
                                                                                                                class="col-sm-3 col-form-label">Working
                                                                                                                time
                                                                                                                pattern</label>
                                                                                                            <div
                                                                                                                class="col-sm-2">
                                                                                                                <select
                                                                                                                    class="form-select form-control">
                                                                                                                    <option
                                                                                                                        value="1">
                                                                                                                        Mon-Fri
                                                                                                                        9-5
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="2">
                                                                                                                        test
                                                                                                                    </option>
                                                                                                                </select>
                                                                                                                <p
                                                                                                                    id="nameError">
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <p
                                                                                                            class="inc-size my-3">
                                                                                                            Based on
                                                                                                            <strong>Mon-Fri
                                                                                                                9-5</strong>,
                                                                                                            this
                                                                                                            employee
                                                                                                            works
                                                                                                            <strong> 35
                                                                                                                hrs</strong>
                                                                                                            over
                                                                                                            <strong> 5
                                                                                                                days
                                                                                                            </strong>
                                                                                                            per week.
                                                                                                        </p>
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <label
                                                                                                                for="firstName"
                                                                                                                class="col-sm-3 col-form-label">Company's
                                                                                                                working
                                                                                                                week,
                                                                                                                excluding
                                                                                                                breaks</label>
                                                                                                            <div
                                                                                                                class="col-sm-2 time-in-hour">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    placeholder="0"
                                                                                                                    maxlength="10"
                                                                                                                    class="form-control"
                                                                                                                    id="firstName"
                                                                                                                    aria-describedby="emailHelp"
                                                                                                                    placeholder="">
                                                                                                                <span
                                                                                                                    class="hour">
                                                                                                                    hrs</span>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-sm-2 time-in-minut">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    maxlength="10"
                                                                                                                    class="form-control"
                                                                                                                    id="firstName"
                                                                                                                    placeholder="0"
                                                                                                                    aria-describedby="emailHelp"
                                                                                                                    placeholder=" ">
                                                                                                                <span
                                                                                                                    class="mins">
                                                                                                                    mins</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <label
                                                                                                                for="firstName"
                                                                                                                class="col-sm-3 col-form-label">Company's
                                                                                                                full
                                                                                                                time
                                                                                                                annual
                                                                                                                leave
                                                                                                                entitlement</label>
                                                                                                            <div
                                                                                                                class="col-sm-2">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    placeholder="0"
                                                                                                                    class="form-control days">
                                                                                                                <p
                                                                                                                    id="nameError">
                                                                                                                </p>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-2">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    placeholder="0"
                                                                                                                    class="form-control hour">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-4 d-flex justify-content-evenly my-3">
                                                                                                    <div
                                                                                                        class="previous">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="back2"
                                                                                                            onclick="back({id:'back',form:'form',count:3})"
                                                                                                            class="previous_btn">Back</button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="continue_save">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            id="next4"
                                                                                                            onclick="next({id:'next',form:'form',count:3})">Next
                                                                                                            step</button>
                                                                                                    </div>
                                                                                                    <div class="cancel">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            onclick="closeMultiEmployee()"
                                                                                                            class="continue_btn"
                                                                                                            id="next3">Cancel</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="container remove-padding">
                                                                                <div class="row" id="form4"
                                                                                    style="display:none;">
                                                                                    <div class="col-md-12">
                                                                                        <div
                                                                                            class="employment-details Annual-leave-entitlement">
                                                                                            <div class="row my-4">
                                                                                                <div class="col-md-12">
                                                                                                    <h5>test's leave
                                                                                                        year</h5>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <form action="">
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <label
                                                                                                                for="firstName"
                                                                                                                class="col-sm-3 col-form-label">Annual
                                                                                                                leave
                                                                                                                year
                                                                                                                start
                                                                                                                date</label>
                                                                                                            <div
                                                                                                                class="col-md-1">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    maxlength="2"
                                                                                                                    placeholder="0"
                                                                                                                    class="form-control">
                                                                                                            </div>
                                                                                                            <div class="col-sm-2"
                                                                                                                style="width: 107px;">
                                                                                                                <select
                                                                                                                    class="form-select form-control">
                                                                                                                    <option
                                                                                                                        value="1">
                                                                                                                        Jan
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="2">
                                                                                                                        Feb
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="3">
                                                                                                                        Mar
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="4">
                                                                                                                        Apr
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="5">
                                                                                                                        May
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="6">
                                                                                                                        Jun
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="7">
                                                                                                                        Jul
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="8">
                                                                                                                        Aug
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="9">
                                                                                                                        Sep
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="10">
                                                                                                                        Oct
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="11">
                                                                                                                        Nov
                                                                                                                    </option>
                                                                                                                    <option
                                                                                                                        value="12">
                                                                                                                        Dec
                                                                                                                    </option>
                                                                                                                </select>
                                                                                                                <p
                                                                                                                    id="nameError">
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <label
                                                                                                                for="firstName"
                                                                                                                class="col-sm-3 col-form-label">Entitlement
                                                                                                                in</label>
                                                                                                            <div
                                                                                                                class="col-md-2">
                                                                                                                <div
                                                                                                                    class="card-1 card-btn">
                                                                                                                    <input
                                                                                                                        type="radio"
                                                                                                                        class="radio_btn day"
                                                                                                                        name="radio-btn"
                                                                                                                        checked>
                                                                                                                    <div
                                                                                                                        class="bg-color">
                                                                                                                        <h5>Days
                                                                                                                        </h5>
                                                                                                                        <p> 0.5
                                                                                                                            days
                                                                                                                            increments
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-2">
                                                                                                                <div
                                                                                                                    class="card-1 card-btn">
                                                                                                                    <input
                                                                                                                        type="radio"
                                                                                                                        class="radio_btn hour"
                                                                                                                        name="radio-btn">
                                                                                                                    <div
                                                                                                                        class="bg-color">
                                                                                                                        <h5>Hours
                                                                                                                        </h5>
                                                                                                                        <p>30
                                                                                                                            minute
                                                                                                                            increments
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row my-3">
                                                                                                            <div
                                                                                                                class="d-flex flex-column col-md-3">
                                                                                                                <label
                                                                                                                    for="full-time"
                                                                                                                    class="col-sm-12 my-3 col-form-label">Company's
                                                                                                                    full
                                                                                                                    time
                                                                                                                    annual
                                                                                                                    leave
                                                                                                                    entitlement</label>
                                                                                                                <label
                                                                                                                    for="annual-leave"
                                                                                                                    class="col-sm-12 my-3 col-form-label">Annual
                                                                                                                    leave
                                                                                                                    entitlement</label>
                                                                                                                <label
                                                                                                                    for="leave-entity"
                                                                                                                    class="col-sm-12 my-3 col-form-label">Annual
                                                                                                                    leave
                                                                                                                    allowance</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="d-flex flex-column col-md-2 days">
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control my-3 day1 col-md-12"
                                                                                                                        id="full-time"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">days</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="annual-leave"
                                                                                                                        class="form-control my-3 day2 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">days</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="leave-entity"
                                                                                                                        class="form-control my-3 day3 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">days</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="d-flex flex-column col-md-2 time">
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control my-3 day1 col-md-12"
                                                                                                                        id="full-time"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">hrs</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="annual-leave"
                                                                                                                        class="form-control my-3 day2 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">hrs</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="leave-entity"
                                                                                                                        class="form-control my-3 day3 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">hrs</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="d-flex flex-column col-md-2 time">
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control my-3 day1 col-md-12"
                                                                                                                        id="full-time"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">mins</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="annual-leave"
                                                                                                                        class="form-control my-3 day2 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">mins</span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="input-position">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="leave-entity"
                                                                                                                        class="form-control my-3 day3 col-md-12"
                                                                                                                        placeholder="0">
                                                                                                                    <span
                                                                                                                        class="child">mins</span>
                                                                                                                </div>
                                                                                                                <p
                                                                                                                    id="nameError">
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-4 d-flex justify-content-evenly my-3">
                                                                                                    <div
                                                                                                        class="previous">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="back3"
                                                                                                            onclick="back({id:'back',form:'form',count:4})"
                                                                                                            class="previous_btn">Back</button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="continue_save">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            id="next5"
                                                                                                            onclick="next({id:'next',form:'form',count:4})">Next
                                                                                                            step</button>
                                                                                                    </div>
                                                                                                    <div class="cancel">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            onclick="closeMultiEmployee()"
                                                                                                            id="next3">Cancel</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="container remove-padding">
                                                                                <div class="row" id="form5"
                                                                                    style="display:none;">
                                                                                    <div class="col-md-12">
                                                                                        <div
                                                                                            class="employment-details summary">
                                                                                            <div class="row my-4">
                                                                                                <div class="col-md-12">
                                                                                                    <h5>Summary</h5>
                                                                                                    <p>You're about to
                                                                                                        add <b
                                                                                                            style="font-weight:500;">
                                                                                                            test
                                                                                                            test</b> to
                                                                                                        the company.</p>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <div
                                                                                                        class="parent-border my-3">
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>
                                                                                                                Employee
                                                                                                                start
                                                                                                                date
                                                                                                            </div>
                                                                                                            <div><b>29
                                                                                                                    Nov
                                                                                                                    2022</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>Leave
                                                                                                                year
                                                                                                                start
                                                                                                                date
                                                                                                            </div>
                                                                                                            <div><b>01
                                                                                                                    January</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>
                                                                                                                Company's
                                                                                                                full
                                                                                                                time
                                                                                                                annual
                                                                                                                leave
                                                                                                                entitlement
                                                                                                            </div>
                                                                                                            <div><b>29
                                                                                                                    Nov
                                                                                                                    2022</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>
                                                                                                                Employee
                                                                                                                start
                                                                                                                date
                                                                                                            </div>
                                                                                                            <div><b>0
                                                                                                                    days</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>
                                                                                                                Allowance
                                                                                                                for
                                                                                                                leave
                                                                                                                year 01
                                                                                                                Jan 2022
                                                                                                                - 31 Dec
                                                                                                                2022
                                                                                                            </div>
                                                                                                            <div><b>0
                                                                                                                    days</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>Working
                                                                                                                time
                                                                                                                pattern
                                                                                                            </div>
                                                                                                            <div><b>0
                                                                                                                    days</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex justify-content-between p-3 B-bottom">
                                                                                                            <div>Public
                                                                                                                holidays
                                                                                                                for
                                                                                                                <small>
                                                                                                                    Deducted
                                                                                                                    from
                                                                                                                    entitlement</small>
                                                                                                            </div>
                                                                                                            <div><b>England
                                                                                                                    &
                                                                                                                    Wales</b>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-12 toggle-check">
                                                                                                    <div class="d-flex">
                                                                                                        <label
                                                                                                            for="check">Send
                                                                                                            test a
                                                                                                            registration
                                                                                                            invite to
                                                                                                            test@gmail.com
                                                                                                        </label>
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            id="check"
                                                                                                            class="custom-check"
                                                                                                            checked>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-4 d-flex justify-content-evenly my-3">
                                                                                                    <div
                                                                                                        class="previous">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            id="back4"
                                                                                                            onclick="back({id:'back',form:'form',count:5})"
                                                                                                            class="previous_btn">Back</button>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="continue_save">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            id="next6"
                                                                                                            onclick="next({id:'next',form:'form',count:5})">Next
                                                                                                            step</button>
                                                                                                    </div>
                                                                                                    <div class="cancel">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="continue_btn"
                                                                                                            onclick="closeMultiEmployee()"
                                                                                                            id="next3">Cancel</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Main add employees step's end -->
                                                                    <!-- Top Bar Info Section End Here -->

                                                                    <!-- Right Side Bar Info Start Here -->

                                                                    <!-- Right Side Bar Info end Here -->
                                                                    <!-- Card information start here -->

                                                                    <!-- Card information end here -->
                                                                </div>



                                                                <div class="d-flex align-items-center">
                                                                    <div class="employees">
                                                                        <p><strong>4 employees</strong> not registered
                                                                            for BrightHR</p>
                                                                    </div>
                                                                    <div class="view-btn">
                                                                        <button type="button">View</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="team-no">
                                                                <form action="" class="row my-5">
                                                                    <div class="form-group col-md-2">
                                                                        <label for="" class="mb-2">Find</label>
                                                                        <div class="">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Name, job title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="" class="mb-2">Filter by</label>
                                                                        <div class="select-pattern">
                                                                            <select name="name" id="name"
                                                                                class="form-select form-control">
                                                                                <option value="name1" selected>All
                                                                                </option>
                                                                                <option value="name2">No team</option>
                                                                                <option value="name2">Terminated
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="" class="mb-2">Sort by</label>
                                                                        <div class="select-pattern">
                                                                            <select name="name" id="name"
                                                                                class="form-select form-control">
                                                                                <option value="name1" selected>Last name
                                                                                    (A-Z)</option>
                                                                                <option value="name2">First name (A-Z)
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="" class="mb-2">Status</label>
                                                                        <div class="select-pattern">
                                                                            <select name="name" id="name"
                                                                                class="form-select form-control">
                                                                                <option value="name1" selected>All
                                                                                </option>
                                                                                <option value="name2">On client visit
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="accordion">
                                                                        <article
                                                                            class="beefup example-opensingle is-open">
                                                                            <div class="d-flex justify-content-between">
                                                                                <div class="item">No team (11)</div>
                                                                                <div class="accordion_icon">
                                                                                    <span class="beefup__head"><i
                                                                                            onclick="rotate()"
                                                                                            class="fa fa-angle-up"
                                                                                            aria-hidden="true"
                                                                                            id="rotateIcon"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="beefup__body">
                                                                                <div class="mockup mockup-sm row my-3">
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="card flex-row">
                                                                                            <div class="link">
                                                                                                <a href="#">WA</a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="profile-detail d-flex flex-column justify-content-center">
                                                                                                <p class="name">William
                                                                                                    Atkins</p>
                                                                                                <div class="">
                                                                                                    <a href="#">View
                                                                                                        full profile</a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="eye-link d-flex align-items-center">
                                                                                                <a href="#"><i
                                                                                                        class="fa fa-eye"
                                                                                                        aria-hidden="true"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </article>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tabTwo">
                                                    <h1>Two</h1>
                                                </div>
                                                <div class="tab-pane show fade active" id="tabThree">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="team-btn my-5">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal" class="">Add a new
                                                                    team</button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" id="show">
                                                                        <div class="modal-content content-modal">
                                                                            <div class="modal-header modal-head">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Add a new
                                                                                    team</h5>
                                                                                <button type="button" class=" close-btn"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"><i
                                                                                        class="fa fa-times"
                                                                                        aria-hidden="true"></i></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-2">
                                                                                        <label
                                                                                            for="team-name">Name</label>
                                                                                    </div>
                                                                                    <input type="text" id="team-name"
                                                                                        placeholder="Please enter a team name..."
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="modal-footer justify-content-between">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary close"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="button" class="save-btn"
                                                                                    onclick="hide()">Select
                                                                                    employees</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-dialog" id="hide"
                                                                        style="display: none; max-width: 800px;">
                                                                        <div class="modal-content content-modal">
                                                                            <div class="modal-header modal-head">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Assign
                                                                                    employees to <span>"test"</span>
                                                                                </h5>
                                                                                <button type="button" class="close-btn"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"><i
                                                                                        class="fa fa-times"
                                                                                        aria-hidden="true"></i></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3 col-md-4">
                                                                                        <select
                                                                                            class="form-select form-control"
                                                                                            aria-label="Default select example">
                                                                                            <option selected=""
                                                                                                value="1">Search by name
                                                                                            </option>
                                                                                            <option value="2">Search by
                                                                                                group</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-sm-3 col-md-4">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="Enter name">
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-4 d-flex justify-content-end">
                                                                                        <button type="button"
                                                                                            class="select-employee">Select
                                                                                            all</button>
                                                                                        <button type="button"
                                                                                            class="select-employee">Deselect
                                                                                            all</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row employee-name my-4">
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="name">
                                                                                            <p>Adam Woods</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="modal-footer justify-content-between">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary close"
                                                                                    data-bs-dismiss=""
                                                                                    onclick="back_Modal()"
                                                                                    id="backBtn">Back</button>
                                                                                <button type="button"
                                                                                    class="save-btn">Select
                                                                                    employees</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex search-team">
                                                                <label for="find">Find</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" id="find" class="form-control"
                                                                        placeholder="Team name">
                                                                </div>
                                                            </div>
                                                            <div class="row my-4">
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card flex-row cards">
                                                                        <div class="name">
                                                                            <p class="name-text">T</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center team-name">
                                                                            <p class="fname">test</p>
                                                                            <p class="no-of-emb">0 members</p>
                                                                        </div>
                                                                        <div class="icons">
                                                                            <p class="edit-icon"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></p>
                                                                            <p class="delet-icon"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Working Pattern form end here -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('rotaStaff.components.footer')