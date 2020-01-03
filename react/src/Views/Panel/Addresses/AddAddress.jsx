import React, { Component } from 'react'

export default class AddAddress extends Component {
  render() {
    return (
      <>
        <div className="row">
                                                    <div className="col-md-12">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.address ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="address" className="bmd-label-floating">آدرس</label>
                                                            <input type="text" className="form-control" id="address" name="address" value={this.state.user.address || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.address || ''}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-md-4">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.country ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="country" className="bmd-label-floating">کشور</label>
                                                            <input type="text" className="form-control" id="country" name="country" value={this.state.user.country || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.country || ''}</p>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-4">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.state ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="state" className="bmd-label-floating">استان</label>
                                                            <input type="text" className="form-control" id="state" name="state" value={this.state.user.state || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.state || ''}</p>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-4">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.city ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="city" className="bmd-label-floating">شهر</label>
                                                            <input type="text" className="form-control" id="city" name="city" value={this.state.user.city || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.city || ''}</p>
                                                        </div>
                                                    </div>
                                                </div>
      </>
    )
  }
}
