import React, {} from 'react';
import * as PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import { routesByName } from 'constants/routes';
import { formFields } from 'modules/auth/signUp/constants';

// TODO: final form or formic integration
const SignUpComponent = (
  {
    onChange,
    onSubmit,
    values,
    submitting,
    error,
  }
) => {

  return (
    <>
      <h1>
        Start your online visit
      </h1>
      <h6>
        This information will help us get you set up with a doctor and make sure you're eligible for treatment
      </h6>
      <div className="mb-5">
        Already have a Rize account?
        {' '}
        <Link to={routesByName.signIn}>
          Login
        </Link>
      </div>
      {
        error && (
          <div className="alert alert-danger mb-2" role="alert">
            {error}
          </div>
        )
      }
      <form onSubmit={onSubmit}>
        <div className="form-group row align-items-center">
          <label htmlFor={formFields.username} className="col-auto mb-0">
            Email address
          </label>
          <div className="col">
            <input
              value={values[formFields.username]}
              onChange={onChange}
              type="email" className="form-control" name={formFields.username} id={formFields.username}
            />
          </div>
        </div>
        <div className="form-group row align-items-center">
          <label className="col-auto mb-0">
            Biological Sex
          </label>
          <div className="col">
            <div className="row">
              <div className="col-auto d-flex align-items-center">
                <input
                  type="radio" name={formFields.gender} value="1" className="mr-2"
                  onChange={onChange}
                  checked={values[formFields.gender] == '1'}
                  id={formFields.gender + '-1'}
                />
                <label htmlFor={formFields.gender + '-1'} className="mb-0">
                  Male
                </label>
              </div>
              <div className="col-auto d-flex align-items-center">
                <input
                  type="radio" name={formFields.gender} value="2" className="mr-2"
                  onChange={onChange}
                  id={formFields.gender + '-2'}
                  checked={values[formFields.gender] == '2'}
                />
                <label htmlFor={formFields.gender + '-2'} className="mb-0">
                  Female
                </label>
              </div>
            </div>
          </div>
        </div>
        <div className="form-group row align-items-center">
          <label htmlFor={formFields.birthDate} className="col-auto mb-0">
            Birthdate
          </label>
          <div className="col">
            <input type="date" className="form-control" name={formFields.birthDate} id={formFields.birthDate}
                   onChange={onChange}
                   value={values[formFields.birthDate]}
            />
          </div>
        </div>
        <div className="form-group row align-items-center">
          <label htmlFor={formFields.zipCode} className="col-auto mb-0">
            ZIP Code
          </label>
          <div className="col">
            <input name={formFields.zipCode} id={formFields.zipCode} className="form-control"
                   onChange={onChange}
                   value={values[formFields.zipCode]}
            />
          </div>
        </div>
        <button type="submit" className="btn btn-primary" disabled={submitting}>
          Submit
        </button>
      </form>
    </>
  );
};

SignUpComponent.propTypes = {
  onChange: PropTypes.func.isRequired,
  onSubmit: PropTypes.func.isRequired,
  values: PropTypes.shape({}).isRequired,
  submitting: PropTypes.bool.isRequired,
  error: PropTypes.node,
};

SignUpComponent.defaultProps = {
  error: null,
};

export default SignUpComponent;
