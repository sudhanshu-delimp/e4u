   

try {
    const socket = io(`${socket_url}`);
    socket.on("connect", () => {
    console.log("Connected to socket server");
    });

    socket.on("agent.assigned", (data) => {
        console.log("agent assigned:", data);
        agentRequestreportTable.ajax.reload();
    });


    socket.on("connect_error", (error) => {
    console.error("Socket connection error:", error);
    });

    socket.on("disconnect", (reason) => {
    console.log("Socket disconnected:", reason);
    });

} 
catch (error) {
    if (error instanceof ReferenceError && error.message.includes("io is not defined")) {
    console.error("Error: Socket.IO not connected OR Libarary not loaded.");
    } else {
    console.error("An unexpected error occurred:", error);
    }
}