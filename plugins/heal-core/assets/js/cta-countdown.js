(function () {
  // Select all countdown containers
  const countdownContainers = document.querySelectorAll(".gt-coming-soon-timer");

  countdownContainers.forEach((countdownContainer) => {
    const eventTimeString = countdownContainer.getAttribute("data-event-time");
    const targetDate = new Date(eventTimeString).getTime();

    const countdownInterval = setInterval(() => {
      const currentDate = Date.now();
      const remainingTime = targetDate - currentDate;

      if (remainingTime <= 0) {
        clearInterval(countdownInterval);
        countdownContainer.innerHTML = "<p>Countdown has ended!</p>";
        return;
      }

      const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
      const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

      // Select the individual elements and update their text content
      countdownContainer.querySelector(".gt-day").textContent = days.toString().padStart(2, "0");
      countdownContainer.querySelector(".gt-hour").textContent = hours.toString().padStart(2, "0");
      countdownContainer.querySelector(".gt-min").textContent = minutes.toString().padStart(2, "0");
      countdownContainer.querySelector(".gt-sec").textContent = seconds.toString().padStart(2, "0");
    }, 1000);
  });
})();
