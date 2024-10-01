<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" />

  <xsl:template match="/books">
    <html>
      <body>
        <h3>Book Store</h3>
        <xsl:for-each select="book[title[@type='fiction'] and price &lt; 30]">
          <span class="book-title">
            <xsl:value-of select="title" />
          </span>
          <span class="book-author">
            <xsl:choose>
              <xsl:when test="count(author) > 1">
                <xsl:value-of select="author[1]" /> et al. </xsl:when>
              <xsl:otherwise>
                <xsl:value-of select="author" />
              </xsl:otherwise>
            </xsl:choose>
          </span>

          <span
            class="book-price"> $<xsl:value-of select="price" />
          </span>
          <br />
        </xsl:for-each>
        <span class="total-cost"> Total Cost: $<xsl:value-of
          select="sum(book[title[@type='fiction'] and price &lt; 30]/price)" />
        </span>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>