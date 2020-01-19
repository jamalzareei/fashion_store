import React from 'react';

// function AuthContext() {
export const authContext = React.createContext({
    token: (localStorage.getItem("token") !== null) ? localStorage.getItem("token") : null,
    user: {}
});


export const initialValeue = {
    token: (localStorage.getItem("token") !== null) ? localStorage.getItem("token") : null,
    user: {}
};
export const reducer = (state, action) => {
    switch (action.type) {
        case 'LOGIN':
            return { ...state, token: action.token, user: action.user }
        case 'LOGOUT':
            return { token: null, user: action.user }
        default:
            return state
    }
}
// }