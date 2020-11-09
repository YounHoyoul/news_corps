import React, { Component } from "react";
import ReactDOM from "react-dom";

class Form extends Component {
  constructor() {
    super();

    this.state = {
      companyName: "",
      phoneNumber: "",
      errors: {
        companyName: '',
        phoneNumber: '',
      }
    };

    this.handleCompanyChange = this.handleCompanyChange.bind(this);
    this.handlePhoneNumberChange = this.handlePhoneNumberChange.bind(this);
    this.handleSubmitForm = this.handleSubmitForm.bind(this);
  }

  handleCompanyChange(event) {
    const { value } = event.target;
    this.setState(() => {
      return {
        companyName : value
      };
    });

    this.clearValidate("companyName")
  }

  handlePhoneNumberChange(event) {
    const { value } = event.target;
    this.setState(() => {
      return {
        phoneNumber : value
      };
    });

    this.clearValidate("phoneNumber");
  }

  clearValidate(name){
    this.setState(() => {
      return { 
        errors : {
          companyName : name == "companyName" ? '' : this.state.errors.companyName,
          phoneNumber : name == "phoneNumber" ? '' : this.state.errors.phoneNumber,
        }
      };
    });
  }

  validateForm(name) {
    let hasError = false;
    const errors = {
      companyName : "",
      phoneNumber : ""
    };

    if(this.state.companyName.length == 0){
      errors.companyName = "Company name is required";
      hasError = true;
    }

    if(this.state.phoneNumber.length == 0){
      errors.phoneNumber = "Phone number is required";
      hasError = true;
    }

    this.setState(() => {
      return { 
        errors : errors
      };
    });

    return hasError;
  }

  handleSubmitForm(event) {
    event.preventDefault();

    if(!this.validateForm()){
      jQuery.post('/wp-admin/admin-ajax.php', {
        "companyName" : this.state.companyName,
        "phoneNumber" : this.state.phoneNumber,
        "action" : "ajax_posthandler"
      } )
      .done( function (response) {
        console.log(response);
      })
      .fail( function (error) {
        console.log(error);
      });
    }
  }

  render() {
    return (
      <form>
        <div className="form-group row">
          <label for="inputPassword" className="col-sm-4 col-form-label">Company Name</label>
          <div class="col-sm-8">
            <input type="text" 
              value={this.state.companyName} 
              onChange={this.handleCompanyChange}
              className="form-control" 
              id="companyName" 
              name="companyName"
              placeholder="Please enter company name" />
            {this.state.errors.companyName.length > 0 && 
              <span className='error'>{this.state.errors.companyName}</span>}   
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" className="col-sm-4 col-form-label">Phone Number</label>
          <div class="col-sm-8">
            <input type="text"
              value={this.state.phoneNumber}  
              onChange={this.handlePhoneNumberChange}
              className="form-control" 
              id="phoneNumber" 
              name="phoneNumber"
              placeholder="Please enter phone number" />
            {this.state.errors.phoneNumber.length > 0 && 
              <span className='error'>{this.state.errors.phoneNumber}</span>}  
          </div>
        </div>
        <div className="form-group row">
          <div className="col-sm-4"></div>
          <div className="col-sm-8">
            <button onClick={this.handleSubmitForm}>
              Submit
            </button>
          </div>
        </div>
      </form>
    );
  }
}

export default Form;

const wrapper = document.getElementById("form_app");
wrapper ? ReactDOM.render(<Form />, wrapper) : false;