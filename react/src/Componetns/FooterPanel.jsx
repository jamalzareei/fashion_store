import React, { Component } from 'react'

export default class FooterPanel extends Component {
  render() {
    return (
        <footer className="footer">
            <div className="container-fluid">
                <nav className="float-left">
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                تیم خلاق
                            </a>
                        </li>
                        <li>
                            <a href="https://creative-tim.com/presentation">
                                درباره ما
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                بلاگ
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                اجازه نامه
                            </a>
                        </li>
                    </ul>
                </nav>
                <div className="copyright float-right">
                    &copy;
                    <script>
                                                    document.write(new Date().getFullYear())
                    </script>, ساخته شده با
                    <i className="material-icons">favorite</i> توسط
                    <a href="https://www.creative-tim.com" target="_blank">تیم خلاق</a> برای وب بهتر.
                    </div>
            </div>
        </footer>
    )
  }
}
