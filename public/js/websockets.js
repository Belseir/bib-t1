let socket;
let loggedInUsers = 0;

let host = "ws://127.0.0.1:9000/";

const init = () => {
  try {
    socket = new WebSocket(host);

    socket.onopen = () => {
      console.log("Welcome - status Open");
    };

    socket.onmessage = (msg) => {
      loggedInUsers = parseInt(msg.data);
      $("#user-count").html(loggedInUsers);
    };

    socket.onclose = () => {
      console.log("Disconnected - status Closed");
    };
  } catch (ex) {
    console.log(ex);
  }
};

const quit = () => {
  if (socket != null) {
    socket.close();
    socket = null;
  }
};

const reconnect = () => {
  quit();
  init();
};
