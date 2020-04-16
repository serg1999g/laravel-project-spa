import React, { PureComponent } from 'react';
import * as PropTypes from 'prop-types';
import SignUpComponent from 'modules/auth/signUp/SignUpComponent';
import { formFields } from 'modules/auth/signUp/constants';
import AuthService from 'modules/auth/AuthService';
import { routesByName } from 'constants/routes';


const initialState = {
  submitting: false,
  error: null,
  form: {
    [formFields.username]: '',
    [formFields.gender]: '',
    [formFields.birthDate]: '',
    [formFields.zipCode]: '',
  },
};

class SignUpContainer extends PureComponent {

  constructor(props) {
    super(props);

    this.state = { ...initialState };
  }

  onChange = ({ target: { name, value } }) => {
    const { form } = this.state;

    this.setState({ form: { ...form, [name]: value, } });
  };

  onSubmit = async (event) => {
    event.preventDefault();

    const {
      form: {
        [formFields.gender]: gender,
        ...form
      }, submitting
    } = this.state;
    const {history} = this.props;

    if (submitting) {
      return;
    }

    this.setState({
      submitting: true,
      error: initialState.error,
    });

    try {
      await AuthService.signUp(
        {
          ...form,
          [formFields.gender]: Number.parseInt(gender, 10),
        }
      );

      history.replace(routesByName.questions);
    } catch (error) {
      this.setState({ error: error.message, submitting: false });
    } finally {
    }
  };

  render() {
    const { form, submitting, error } = this.state;

    return (
      <SignUpComponent
        onChange={this.onChange}
        onSubmit={this.onSubmit}
        values={form}
        submitting={submitting}
        error={error}
      />
    );
  };
}

SignUpContainer.propTypes = {};

SignUpContainer.defaultProps = {};

export default SignUpContainer;
