{if $bLoadData}
{literal}
<script type="text/javascript">
    var _cio = _cio || [];
    (function() {
        var a,b,c;a=function(f){return function(){_cio.push([f].
            concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
            "sidentify","track","page","cookie"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
        var t = document.createElement('script'),
            s = document.getElementsByTagName('script')[0];
        t.async = true;
        t.id    = 'cio-tracker';
        t.setAttribute('data-site-id', 'd8156aee3332a2cc63c8');
        t.src = 'https://assets.customer.io/assets/track.js';
        s.parentNode.insertBefore(t, s);
    })();
</script>
<script type="text/javascript">
    _cio.identify({
    {/literal}
        id: '{$aCustomerIo.user_id}',
        email: '{$aCustomerIo.email}',
        created_at: {$aCustomerIo.joined},
        last_login: {$aCustomerIo.last_login},
        first_name: '{$aCustomerIo.first_name}',
        last_name: '{$aCustomerIo.last_name}',
        user_group: '{$aCustomerIo.user_group_title}'
    {literal}
    });
</script>
{/literal}
{/if}