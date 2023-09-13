function handleAjaxChat() {
    fetch('chatHandling.php')
      .then(response => response.text())
      .then(text => {
        document.getElementById('messagePanel').innerHTML = text; //this is updating the message panel with new messages
      })
      .catch(error => {
        console.error('Error fetching chat messages:', error); //this catches the error and then also tells us that there was an error getting the messages
      });
  }
  
  setInterval(handleAjaxChat, 1500); //this just keeps the chat up to date by calling the function every 1.5 seconds (1,500 milliseconds)
  