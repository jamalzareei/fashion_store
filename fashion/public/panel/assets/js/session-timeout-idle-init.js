var UIIdleTimeout = function() {
	return {
		init: function() {
			var o;
			$.idleTimeout("#idle-timeout-dialog", "#idle-timeout-dialog-keepalive", {
				idleAfter: 5,
				timeout: 30,
				pollingInterval: 5,
				keepAliveURL: "#",
				serverResponseEquals: "OK",
				onTimeout: function() {
					window.location = "lock-screen.html";
				},
				onIdle: function() {
					$("#idle-timeout-dialog").modal("show"), o = $("#idle-timeout-counter"), $("#idle-timeout-dialog-keepalive").on("click", function() {
						$("#idle-timeout-dialog").modal("hide");
					});
				},
				onCountdown: function(e) {
					o.html(e);
				}
			});
		}
	}
}();
jQuery(document).ready(function() {
	UIIdleTimeout.init();
});
