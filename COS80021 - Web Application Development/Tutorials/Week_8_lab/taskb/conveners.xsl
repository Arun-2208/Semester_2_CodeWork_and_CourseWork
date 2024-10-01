<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" />
  <xsl:template match="/">
    <html>
      <head>
        <title>Units</title>
      </head>
      <body>
        <h4>Units with More than 12.5 Credit Points :</h4>
        <xsl:for-each select="Units/Unit[points &gt; 12.5]">
          <p>
            <strong>Title:</strong>
            <xsl:value-of select="title" />
            <br />
            <strong>Faculty:</strong>
            <xsl:value-of select="Faculty" />
            <br />
            <strong>Group:</strong>
            <xsl:value-of select="group" />
            <br />
          </p>
        </xsl:for-each>

        <h4>Number of Units Offered by CSSE:</h4>
        <p>
          <xsl:value-of select="count(Units/Unit[group='CSSE'])" />
        </p>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>