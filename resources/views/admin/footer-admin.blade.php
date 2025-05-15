<footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="admin/js/core/popper.min.js"></script>
  <script src="admin/js/core/bootstrap.min.js"></script>
  <script src="admin/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="admin/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="admin/js/plugins/chartjs.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="admin/js/dropzone-min.js"></script>
  <script src="js/es-ES.js"></script>
  <script src="DataTables/datatables.min.js"></script>
  <script>
    const base_url = '';
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="admin/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>