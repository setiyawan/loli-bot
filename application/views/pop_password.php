<form id="changePassword" class="modal fade" action="<?= base_url() ?>index.php/user/changePassword" method="post" style="display: none; align:center">
            <div class="modal-dialog modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title"> Ganti Password </h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0">
                            <tr>
                                <td>
                                    password Lama
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    password Baru
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ulangi Password
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password2">
                                    </div>
                                </td>
                            </tr>
                            </table>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>