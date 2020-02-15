var SessionTimeout = function () {
	return {
		init: function () {
			$.sessionTimeout({
				title: "هشدار اتمام مهلت جلسه",
				message: "جلسه شما به زودی منقضی می شود.",
				redirUrl: "lock-screen.html",
				logoutUrl: "login2.html",
				warnAfter: 5000,
				redirAfter: 20000,
				keepAliveUrl: "#",
				ignoreUserActivity: true,
				countdownMessage: "قفل صفحه تا {timer} ثانیه.",
				countdownBar: true,
				logoutButton: ' خروج از حساب',
				keepAliveButton: 'ماندن در صفحه'
			});
		}
	}
}();
jQuery(document).ready(function () {
	SessionTimeout.init();
});
