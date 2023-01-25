<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version = "1.0"
    xmlns:xsl =  "http://www.w3.org/1999/XSL/Transform">
    
    <xsl:output method="html" doctype-system="about:leagcy-compat"/>

    <xsl:template match="/">
        <html>
            <xsl:apply-templates/>
        </html>
    </xsl:template>

    <xsl:template match="contacts">
        <head>
            <meta charset = "utf-8"/>
            <link rel = "stylesheet" type = "text/css" href = "style.css"/>
            <title>Contacts</title>
        </head>
        
        <body>
            <table>
                <xsl:for-each select = "contacts/contact">

                    <xsl:sort select = "name" data-type="text" order="ascending"/>

                    <tr>
                        <td>[<xsl:value-of select="@group"/>] </td>
                        <td><xsl:value-of select="name"/> </td>
                        <td>(<xsl:value-of select="tel"/>)</td>
                    </tr>
                    <tr>
                        <td>[<xsl:value-of select="birth"/>] </td>
                        <td><xsl:value-of select="email"/> </td>
                        <td>(<xsl:value-of select="memo"/>)</td>
                    </tr>
                </xsl:for-each>
            </table>
        </body>
    </xsl:template>
</xsl:stylesheet>