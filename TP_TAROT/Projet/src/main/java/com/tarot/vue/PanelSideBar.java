package com.tarot.vue;


import com.tarot.model.Player;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import java.awt.*;

public class PanelSideBar extends JPanel implements IGotBtnClickable {

    private final JPanel infoPlayerPanel = new JPanel();

    private final JLabel iconPlayer = new JLabel();
    private final JLabel playerName = new JLabel();

    private final JButton saveProfileButton = new JButton();

    /**
     * Constructor
     */
    public PanelSideBar()
    {
        super();
        this.setLayout(new BorderLayout());
        this.setBackground(new Color(3,3,32));
        initComponent();
        this.add(infoPlayerPanel,BorderLayout.NORTH);
        this.add(saveProfileButton,BorderLayout.SOUTH);

    }

    /**
     * Init Components
     */
    private void initComponent()
    {
        this.playerName.setHorizontalAlignment(SwingConstants.CENTER);
        this.playerName.setForeground(Color.WHITE);
        this.playerName.setFont(new Font("Roboto",Font.PLAIN,20));
        this.iconPlayer.setHorizontalAlignment(SwingConstants.CENTER);
        this.infoPlayerPanel.setLayout(new BorderLayout());
        this.infoPlayerPanel.setOpaque(false);
        this.infoPlayerPanel.setSize(-1,-1);
        this.infoPlayerPanel.add(this.iconPlayer,BorderLayout.NORTH);
        this.infoPlayerPanel.add(this.playerName,BorderLayout.CENTER);
        this.infoPlayerPanel.setBorder(new EmptyBorder(10,5,10,5));


        this.saveProfileButton.setText("Sauvegarder mon profil");
        this.saveProfileButton.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+"save.png"));
        this.saveProfileButton.setOpaque(false);

        this.saveProfileButton.setBackground(null);
        this.saveProfileButton.setForeground(Color.WHITE);
        this.saveProfileButton.setBorder(new EmptyBorder(10,0,10,0));
        this.saveProfileButton.setVerticalAlignment(SwingConstants.CENTER);

        VueTest.mapBtnClickAction.put(this.saveProfileButton,this);
        ButtonAction btnAct = new ButtonAction();
        this.saveProfileButton.addMouseListener(btnAct);
    }

    public void saveProfile()
    {
        VueTest.listController.get(0).savePlayerProfile();
    }

    /**
     *
     * @param p the new player
     */
    public void update(Player p) {
        this.playerName.setText(p.getFirstname());
        this.iconPlayer.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+p.getImageIcon()));
    }

    /**
     * Save profile
     * @param c Component to check (In case there is more)
     */
    @Override
    public void pressBtn(Component c) {
        if(c == this.saveProfileButton)
            this.saveProfile();
    }
}
