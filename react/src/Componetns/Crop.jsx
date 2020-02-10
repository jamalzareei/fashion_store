import React, { Component } from 'react';
import Cropper from 'react-cropper';
import 'cropperjs/dist/cropper.css'; // see installation section above for versions of NPM older than 3.0.0
// If you choose not to use import, you need to assign Cropper to default
// var Cropper = require('react-cropper').default

const cropper = React.createRef(null);

// class Demo extends Component {
export default class Crop extends Component {
    constructor(props) {
        super(props);
        this.state =
        {
            src: '',
            cropResult: null,
        };
        this.onChangeImage = this.onChangeImage.bind(this);
        this.cropImage = this.cropImage.bind(this);
        
    }

    onChangeImage(e) {
        e.preventDefault();
        let files;
        if (e.dataTransfer) {
            files = e.dataTransfer.files;
        } else if (e.target) {
            files = e.target.files;
        }
        const reader = new FileReader();
        reader.onload = () => {
            this.setState({ src: reader.result });
        };
        reader.readAsDataURL(files[0]);
    }

    cropImage() {
        if (typeof this.cropper.getCroppedCanvas() === 'undefined') {
            return;
        }
        this.props.updateSrc(this.cropper.getCroppedCanvas().toDataURL())
    }

    render() {
        return (
            <div>
                {/* <div>انتخاب و برش عکس</div> */}


                <div>
                    <span class="btn btn-raised btn-round btn-default btn-file">
                        <span class="fileinput-new">انتخاب عکس پروفایل</span>
                        {/* <span class="fileinput-exists">Change</span> */}
                        <input type="file" id="uploadImage" name="uploadImage" onChange={this.onChangeImage} />
                    </span>
                </div>
                <Cropper
                    style={{ height: 300, width: '100%' }}
                    preview=".img-preview"
                    guides={false}
                    src={this.state.src}
                    ref={cropper => { this.cropper = cropper; }}
                    cropBoxResizable={this.props.cropBoxResizable}
                    minCropBoxWidth={this.props.height}
                    maxCropBoxWidth={this.props.width}
                    aspectRatio={this.props.width / this.props.height}
                    // crop={this.cropImage}
                />

                <button onClick={this.cropImage} style={{ float: 'right' }}>
                    تایید عکس
                </button>


            </div>
        );
    }
}