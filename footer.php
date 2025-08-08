<style>
  footer {
    text-align: center; 
    margin-top: auto;
    background-color: rgba(8, 114, 74, 0.8);
    font-family: 'Times New Roman', Times, serif;
    color: black;
    padding: 5px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  footer p {
    font-size: 16px;
    margin-top: 10px;
  }
  footer a {
    color: black !important;
    text-decoration: none !important;
  }
  @media screen and (max-width: 600px) {
    footer p {
      font-size: 10px;
    }
  }
</style>

<footer>
  <div style="max-width: 1200px; margin: auto;">
    <p>&copy; <?php echo date("Y"); ?> Hire Map | All Rights Reserved.</p>
    <p>
      Need help? Email us at
      <a href="mailto:support@hiremap.com" target="_blank">support@hiremap.com</a>
    </p>
  </div>
</footer>