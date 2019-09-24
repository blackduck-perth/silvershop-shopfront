<%--
      This template is intended to be used as an example only,
      and would generally be overridden within your own project
--%>

<% if $SectionsForDisplay %>
<div class="shopfront-page">
    <h1>$Title</h1>

    <% loop $SectionsForDisplay %>
    <div class="shopfront-section">
        <h2 class="shopfront-section-title">$Title</h2>
        <div class="shopfront-section-products">
            <ul>
            <% loop $Products %>
                <% if $canView %>
                <li class="product">
                    <h3><a href="$Link">$Title</a></h3>
                    <% if $Image %>
                        <a href="$Link"><img src="$Image.Link" /></a>
                    <% end_if %>
                </li>
                <% end_if %>
            <% end_loop %>
            </ul>
        </div>
    </div>
    <% end_loop %>
</div>
<% end_if %>
