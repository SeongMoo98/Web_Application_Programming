<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version = "1.0"
    xmlns:xsl =  "http://www.w3.org/1999/XSL/Transform">


    <xsl:output method="html" doctype-system="about:leagcy-compat"/>

    <!-- xsl에선 template을 먼저 찾는다 -->
    
    <xsl:template match="/">
        <html>
            <!-- 각각 매칭된 template 적용하기 -->
            <xsl:apply-templates/>
        </html>
    </xsl:template>

    <xsl:template match="mylink">
        <head>
            <meta charset = "utf-8"/>
            <!-- <link rel = "stylesheet" type = "text/css" href = "style1.css"/> -->
            <title>Mylink</title>
        </head>
        
        <body>
            <img>
                <xsl:attribute name="src">
                    <xsl:value-of select="icon"/>
                </xsl:attribute>
            </img>

            <label>
                [<xsl:value-of select = "classify"/>]
                <a>
                    <xsl:attribute name="href">
                        <xsl:value-of select="link"/>
                    </xsl:attribute>
                    <xsl:value-of select="title"/>
                </a>
            </label>
            <label>(<xsl:value-of select="count"/>회 방문)</label>
        </body>
    </xsl:template>

</xsl:stylesheet>