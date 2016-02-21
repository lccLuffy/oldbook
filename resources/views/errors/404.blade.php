@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top: 200px;margin-bottom: 500px">
                <table border="0" bordercolor="#999999" align="center" cellpadding="20" cellspacing="0">

                    <tbody>
                    <tr>
                        <td align="left"><pre>     ##           ##
    # #   ###    # #
   #  #  #  ##  #  #
  ###### # # # ######
      #  ##  #     #
      #   ###      #</pre>
                        </td>
                        <td align="left"><pre>            .~~~.
  (\__/)  .'     )
  /o o  \/     .~
 {o_,    \    {
   / ,  , )    \
   `~  '-' \    }
  _(    (   )_.'
  '---..{____}</pre>
                        </td>
                    </tr>
                    <tr valign="center">
                        <td align="center" colspan="3"><code><b>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">出错了</div>

                                        <div class="panel-body">
                                            您访问的页面不存在
                                        </div>
                                        <div class="panel-footer">
                                            <a href="{{url('/')}}">点击回到主页</a>
                                        </div>
                                    </div>
                                </b></code></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection