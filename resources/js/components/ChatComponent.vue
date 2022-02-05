<template>
  <div>
    <div
      style="width: 100vw; position: relative; margin-left: -50vw; left: 50%"
    >
      <div
        style="position: fixed;
    bottom: 0;
    right: 0;
    margin-bottom: 3rem;
}"
      >
        <button class="no-style-button">
          <div>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#0d6efd"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="display: block"
              class="chat-icon"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="25"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="12" cy="15" r="1"></circle>
                <circle cx="19" cy="15" r="1"></circle>
                <circle cx="5" cy="15" r="1"></circle>
              </svg>
              <path
                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"
              ></path>
            </svg>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
</script>

<style>
.chat-icon {
  transition: 0.1s ease-out;
}
.chat-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
</style>
