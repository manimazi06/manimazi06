<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Development Works</header>				
				<div class="tools">
					  <?php echo $this->Html->link(__('Add Development Works<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				</div>
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    
                                        <?php if ($developmentWorks != '') {  ?>
											<div class="table-scrollable">
												<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
													<thead>
														<tr class="text-center">
															<th> Sno </th>
															<th> Name </th>
															<th> Actions </th>
														</tr>
													</thead>
													<tbody>
														<?php $sno = 1;
															foreach ($developmentWorks as $developmentWork) : ?>
															<tr class="odd gradeX">
																<td class="text-center"><?php echo $sno; ?></td>
																<td class="title"><?php echo $developmentWork['name'] ?></td>

																<td class="text-center">
																	<div class="btn-icon tooltipster" title="Edit">
																		<?php echo $this->Html->link(__('<span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo3/dist/../src/media/svg/icons/Communication/Write.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"/>
																			<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
																			<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																		</g>
																	</svg><!--end::Svg Icon--></span>'), ['action' => 'edit', $developmentWork['id']], ['escape' => false]); ?>
																					</div>

																</td>

															</tr>
														<?php $sno++;
															endforeach; ?>
													</tbody>
												</table>
											</div>
                                
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>